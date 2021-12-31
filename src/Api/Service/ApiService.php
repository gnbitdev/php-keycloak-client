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

    public function createUser(User $user) : User
    {
        

        $response = $this->request('POST', 'users', $user->toArray());

        if($response->getStatusCode() == 201)
        {   
            return $this->getUserByUsername($user->username);
        }

        throw new Exception('Error creating user');

       
    }

    public function getUserByUsername(string $username)
    {
        $response = $this->request('GET', "users?username=$username");

        return UserFactory::make($response);
    }

    public function updateUser(User $user, string $userId)
    {
        
        $response = $this->request('PUT', "users/$userId", $user->toArray());

        if($response->getStatusCode() == 200)
        {   
            $res = $this->request('GET', "users/$userId");

            return UserFactory::make($res);
        }

        throw new Exception('Error updating user');
          
    }

    public function setUserPassword( string $userId, bool $isTemporary, string $password)
    {
        $response = $this->request('PUT', "users/$userId/reset-password", [
            'isTemporary' => $isTemporary,
            'password' => $password
        ]);

        if($response->getStatusCode() == 204)
        {   
            return true;
        }

        throw new Exception('Error setting user password');        
    }


    public function toggleUserEnabled(string $userId, bool $enabled)
    {

        $response = $this->request('PUT', "users/$userId", [
            'enabled' => $enabled
        ]);

        if($response->getStatusCode() == 204)
        {   
            return true;
        }

        throw new Exception('Error setting user enabled');
    }



    public function deleteUser(string $id)
    {
    
        $response = $this->request('DELETE', "users/$id");

        if($response->getStatusCode() == 204)
        {   
            return true;
        }

        throw new Exception('Error deleting user');
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

    public function getRoleByUserId(string $userId): array
    {
        $roles = $this->request('GET', "users/{$userId}/role-mappings/realm");

        return array_map(function ($role) {
            return RoleFactory::make($role);
        }, $roles);
    }

    public function getRoleByName(string $roleName): Role
    {
        $role = $this->request('GET', "roles/{$roleName}");

        return RoleFactory::make($role);
    }

    public function getRoleById(string $roleId): Role
    {
        $role = $this->request('GET', "roles-by-id/{$roleId}");

        return RoleFactory::make($role);
    }
    
    public function createRole(Role $role) : Role
    {
        
        $response = $this->request('POST', 'roles', $role->toArray());

        if($response->getStatusCode() == 201)
        {   
            return $this->getRoleByName($role->name);
        }

        throw new Exception('Error creating role');
    }

    

    public function updateRoleByName(Role $role, string $roleName)
    {
        $response = $this->request('PUT', "roles/{$roleName}", $role->toArray());

        if($response->getStatusCode() == 200)
        {   
            return $this->getRoleByName($roleName);
        }

        throw new Exception('Error updating role');  
    }

    public function updateRoleById(Role $role, string $roleId)
    {
        $response = $this->request('PUT', "roles-by-id/{$roleId}", $role->toArray());

        if($response->getStatusCode() == 200)
        {   
            return $this->getRoleById($roleId);
        }

        throw new Exception('Error updating role');        
    }


    public function deleteRoleByName(string $roleName)
    {
       
        $response = $this->request('DELETE', "roles/{$roleName}");

        if($response->getStatusCode() == 204)
        {   
            return true;
        }

        throw new Exception('Error deleting role');

    }

    public function deleteRoleById(string $roleId)
    {
        $response = $this->request('DELETE', "roles-by-id/{$roleId}");

        if($response->getStatusCode() == 204)
        {   
            return true;
        }

        throw new Exception('Error deleting role');         
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

    
    public function getGroupByName(string $groupName)
    {
        $group = $this->request('GET', "groups/{$groupName}");

        return GroupFactory::make($group);
    }
    
    public function getGroupById(string $id): Group
    {
        $group = $this->request('GET', "groups/$id");

        return GroupFactory::make($group);
    }
    
    public function createGroup(Group $group) : Group
    {
        
        $response = $this->request('POST', 'groups', $group->toArray());

        if($response->getStatusCode() == 201)
        {   
            return $this->getGroupByName($group->name);
        }

        throw new Exception('Error creating group');       
    }

    public function updateGroup(Group $group, string $groupName)
    {
        
        $response = $this->request('PUT', "groups/{$groupName}", $group->toArray());

        if($response->getStatusCode() == 200)
        {   
            return $this->getGroupByName($groupName);
        }

        throw new Exception('Error updating group');
         
    }


    public function deleteGroupByName(string $groupName)
    {
        $response = $this->request('DELETE', "groups/{$groupName}");

        if($response->getStatusCode() == 204)
        {   
            return true;
        }

        throw new Exception('Error deleting group');
    }


    // Request n Authentication

    
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
}
