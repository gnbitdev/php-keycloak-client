<?php

namespace KeycloakApiClient\Api\Service;

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

    private function request(string $method, string $uri): array
    {
        $token = $this->getToken();

        $response = $this->htttpClient->request(
            $method,
            "/auth/admin/realms/{$this->conn->realm}/{$uri}",
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token->accessToken,
                    'Content-Type'  => 'application/json'
                ]
            ]
        );
        return json_decode($response->getBody()->getContents(), true);
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
     * Groups
     */

    public function getGroups(): array
    {
        $groups = $this->request('GET', 'groups');

        return array_map(function ($group) {
            return GroupFactory::make($group);
        }, $groups);

    }

    public function getGroup(string $id): Group
    {
        $group = $this->request('GET', "groups/$id");

        return GroupFactory::make($group);
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

    public function getRole(string $id): Role
    {
        $role = $this->request('GET', "roles/$id");

        return RoleFactory::make($role);
    }
}
