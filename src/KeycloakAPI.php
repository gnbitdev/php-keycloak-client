<?php

namespace KeycloakApiClient;

use GuzzleHttp\Client;

class KeycloakApi
{
    private $entity;

    public function __construct(KeycloakApiEntity $keycloakApiEntity, Client $client)
    {
        $this->entity = $keycloakApiEntity;
        $this->client = $client;
    }


    public function ApiAuthenticate()
    {
        $this->baseUrl = "{$this->entity->baseUrl}/auth/realms/{$this->entity->getRealm()}/protocol/openid-connect/token";
        $response = $this->client->post($this->baseUrl, [
            'form_params' => [
                'username' => $this->entity->getUsername(),
                'password' => $this->entity->getPassword(),
                'grant_type' => 'password',
                'client_id' => $this->entity->getClientId(),
                'client_secret' => $this->entity->getClientSecret(),
            ]
        ]);
        
        $response = json_decode((string) $response->getBody(), true);
        
        return $response['access_token'];

    }

    // User Methods

    public function storeUser(User $user)
    {   
        $response = $this->client->post("{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users", 
        [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                'Content-Type' => 'application/json'
            ],
            'json' => $user->toArray()
        ]);
        $response = $this->client->post();

        return $response->getBody()->getContents();
    }

    public function setUserPassword( String $userId, bool $isTemporary, String $password)
    {
        $response = $this->client->post("{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/{$userId}/reset-password", 
        [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'temporary' => $isTemporary,
                'value' => $password
            ]
        ]);

        $response = $this->client->post();

        return $response->getBody()->getContents();
    }
    

    public function getUser(String $userId)
    {
        $response = $this->client->get(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/{$userId}",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $response->getBody()->getContents();
    }

    public function getUsers()
    {
        $response = $this->client->get(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $response->getBody()->getContents();
    }

    public function updateUser(User $user, String $userId)
    {
        $response = $this->client->post("{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/{$userId}", 
        [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                'Content-Type' => 'application/json'
            ],
            'json' => $user->toArray()
        ]);
        
        $response = $this->client->post();

        return $response->getBody()->getContents();
    }

    public function deleteUser(String $userId)
    {
        $response = $this->client->delete(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/{$userId}",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $response->getBody()->getContents();
    }

    // Role Methods

    public function getRoles()
    {
        $response = $this->client->get(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $response->getBody()->getContents();
    }

    public function getRole(String $roleId)
    {
        $response = $this->client->get(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/{$roleId}",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $response->getBody()->getContents();
    }

    public function storeRole(Role $role)
    {
        $response = $this->client->post(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ],
                'json' => $role->toArray()
            ]
        );

        return $response->getBody()->getContents();
    }

    public function updateRole(Role $role, String $roleName)
    {
        $response = $this->client->post(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/{$roleName}",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ],
                'json' => $role->toArray()
            ]
        );

        return $response->getBody()->getContents();
    }
    

    public function deleteRole(String $roleName)
    {
        $response = $this->client->delete(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/{$roleName}",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $response->getBody()->getContents();
    }

    // Client Methods

    public function getClients()
    {
        $response = $this->client->get(
            "{$this->entity->getUrl()}/{$this->entity->getBasePath()}/{$this->entity->getRealm()}/clients/",
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $response->getBody()->getContents();
    }

}

?>