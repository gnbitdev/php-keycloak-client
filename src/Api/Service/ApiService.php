<?php

namespace KeycloakApiClient\Api\Service;

use Exception;
use GuzzleHttp\Client;
use KeycloakApiClient\Api\Entity\Connection;
use KeycloakApiClient\Api\Entity\Group;
use KeycloakApiClient\Api\Entity\GroupFactory;
use KeycloakApiClient\Api\Entity\Role;
use KeycloakApiClient\Api\Entity\RoleFactory;
use KeycloakApiClient\Api\Entity\Token;
use KeycloakApiClient\Api\Entity\User;
use KeycloakApiClient\Api\Entity\UserFactory;

class ApiService
{

    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn        = $conn;
        $this->htttpClient = new Client([
            'base_uri' => $this->conn->baseUrl
        ]);
    }

    // Request n Authentication

    private function request(string $method, string $uri, array $data = [] )
    {
        $token = $this->getToken();

        $request = [
            'headers' => [
                'Authorization' => 'Bearer '.$token->accessToken,
                'Content-Type'  => 'application/json'
            ]
        ];

        if (!empty($data)) $request['json'] = $data;

        $response = $this->htttpClient->request(
            $method,
            "/auth/admin/realms/{$this->conn->realm}/{$uri}",
            $request
        );
        
        return $method=='GET' ? json_decode($response->getBody()->getContents(), true) : $response ; 
    }


    public function getToken(): Token
    {

        $response = $this->htttpClient->request(
            "POST",
            "/auth/realms/{$this->conn->realm}/protocol/openid-connect/token",
            [
                'form_params' => $this->conn->credentials->toArray()
            ]
        );

        $token = json_decode((string) $response->getBody(), true);

        return new Token(
            $token['access_token'],
            $token['expires_in'],
            $token['refresh_expires_in'],
            $token['refresh_token'],
            $token['token_type'],
            $token['not-before-policy'],
            $token['scope']
        );
    }

    /**
     * Users
     */

    public function getUser(string $id) : User
    {
        $user = $this->request('GET', "users/$id");
        return UserFactory::make($user);
    }

    public function getUsers() : array
    {
        $users = $this->request('GET', 'users');

        return array_map(function ($user) {
            return UserFactory::make($user);
        }, $users);
    }

    public function storeUser(User $user) : User
    {
        try{

            $response = $this->request('POST', 'users', $user->toArray());

            if($response->getStatusCode() == 201)
            {   
                $res = $this->request('GET', 'users?username='.$user->username);

                return UserFactory::make($res);
            }

            throw new Exception('Error creating user');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    public function updateUser(User $user, String $userId)
    {
        try{

            $response = $this->request('PUT', "users/$userId", $user->toArray());

            if($response->getStatusCode() == 200)
            {   
                $res = $this->request('GET', "users/$userId");

                return UserFactory::make($res);
            }

            throw new Exception('Error updating user');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    public function setUserPassword( String $userId, bool $isTemporary, String $password)
    {
        try{

            $response = $this->request('PUT', "users/$userId/reset-password", [
                'isTemporary' => $isTemporary,
                'password' => $password
            ]);

            if($response->getStatusCode() == 204)
            {   
                return true;
            }

            throw new Exception('Error setting user password');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    public function toggleUserEnabled(String $userId, bool $enabled)
    {
        try{

            $response = $this->request('PUT', "users/$userId", [
                'enabled' => $enabled
            ]);

            if($response->getStatusCode() == 204)
            {   
                return true;
            }

            throw new Exception('Error setting user enabled');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }



    public function deleteUser(string $id)
    {
        try{

            $response = $this->request('DELETE', "users/$id");

            if($response->getStatusCode() == 204)
            {   
                return true;
            }

            throw new Exception('Error deleting user');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    
     /**
      * Roles
      */
    
    public function getRoles(): array
    {
        $roles = $this->request('GET', 'roles');

        return array_map(function ($role) {
            return RoleFactory::make($role);
        }, $roles);
    }

    public function getRoleByUserId(String $userId): array
    {
        $roles = $this->request('GET', "users/{$userId}/role-mappings/realm");

        return array_map(function ($role) {
            return RoleFactory::make($role);
        }, $roles);
    }

    public function getRoleByName(String $roleName): Role
    {
        $role = $this->request('GET', "roles/{$roleName}");

        return RoleFactory::make($role);
    }

    public function getRoleById(String $roleId): Role
    {
        $role = $this->request('GET', "roles-by-id/{$roleId}");

        return RoleFactory::make($role);
    }
    
    public function storeRole(Role $role) : Role
    {
        try{

            $response = $this->request('POST', 'roles', $role->toArray());

            if($response->getStatusCode() == 201)
            {   
                $res = $this->getRoleByName($role->name);

                return RoleFactory::make($res);
            }

            throw new Exception('Error creating role');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    

    public function updateRoleByName(Role $role, String $roleName)
    {
        try{

            $response = $this->request('PUT', "roles/{$roleName}", $role->toArray());

            if($response->getStatusCode() == 200)
            {   
                $res = $this->getRoleByName($roleName);

                return RoleFactory::make($res);
            }

            throw new Exception('Error updating role');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    public function updateRoleById(Role $role, String $roleId)
    {
        try{

            $response = $this->request('PUT', "roles-by-id/{$roleId}", $role->toArray());

            if($response->getStatusCode() == 200)
            {   
                $res = $this->getRoleById($roleId);

                return RoleFactory::make($res);
            }

            throw new Exception('Error updating role');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }


    public function deleteRoleByName(String $roleName)
    {
        try{

            $response = $this->request('DELETE', "roles/{$roleName}");

            if($response->getStatusCode() == 204)
            {   
                return true;
            }

            throw new Exception('Error deleting role');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    public function deleteRoleById(String $roleId)
    {
        try{

            $response = $this->request('DELETE', "roles-by-id/{$roleId}");

            if($response->getStatusCode() == 204)
            {   
                return true;
            }

            throw new Exception('Error deleting role');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    /**
     * Groups
     */

    public function getGroups(): array
    {
        $groups = $this->request('GET', 'groups');

        return array_map(function ($group) {
            return GroupFactory::make($group);
        }, $groups);

    }

    
    public function getGroupByName(String $groupName)
    {
        $group = $this->request('GET', "groups/{$groupName}");

        return GroupFactory::make($group);
    }
    
    public function getGroupById(string $id): Group
    {
        $group = $this->request('GET', "groups/$id");

        return GroupFactory::make($group);
    }
    
    public function storeGroup(Group $group) : Group
    {
        try{

            $response = $this->request('POST', 'groups', $group->toArray());

            if($response->getStatusCode() == 201)
            {   
                $res = $this->getGroupByName($group->name);

                return GroupFactory::make($res);
            }

            throw new Exception('Error creating group');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }

    public function updateGroup(Group $group, String $groupName)
    {
        try{

            $response = $this->request('PUT', "groups/{$groupName}", $group->toArray());

            if($response->getStatusCode() == 200)
            {   
                $res = $this->getGroupByName($groupName);

                return GroupFactory::make($res);
            }

            throw new Exception('Error updating group');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }


    public function deleteGroupByName(String $groupName)
    {
        try{

            $response = $this->request('DELETE', "groups/{$groupName}");

            if($response->getStatusCode() == 204)
            {   
                return true;
            }

            throw new Exception('Error deleting group');

        } catch (Exception $e) {
         
            throw new Exception($e->getMessage());
        }    
    }
}
