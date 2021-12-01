<?php

namespace KeycloakApiClient;

use GuzzleHttp\Client;

class KeycloakApi
{
    private $entity;
    private $accessToken;
    private $refreshToken;

    public function __construct(KeycloakApiEntity $keycloakApiEntity, Client $client)
    {
        $this->entity = $keycloakApiEntity;
        $this->client = $client;
    }


    public function ApiAuthenticate()
    {
        $formParams = [
            'username' => $this->entity->getUsername(),
            'password' => $this->entity->getPassword(),
            'grant_type' => 'password',
            'client_id' => $this->entity->getClientId(),
            'client_secret' => $this->entity->getClientSecret(),
        ];

        $url = "{$this->entity->getBaseUrl()}/auth/realms/{$this->entity->getRealm()}/protocol/openid-connect/token";
        $response = $this->client->post($url, [
            'form_params' => $formParams
        ]);
        
        $response = json_decode((string) $response->getBody(), true);
        
        $this->accessToken = $response['access_token'];
        $this->refreshToken = $response['refresh_token'];

        return $response['access_token'];

    }

    public function ApiLogout()
    {
        $formParams = [
            'username' => $this->entity->getUsername(),
            'password' => $this->entity->getPassword(),
            'grant_type' => 'password',
            'client_id' => $this->entity->getClientId(),
            'client_secret' => $this->entity->getClientSecret(),
            'refresh_token' => $this->refreshToken
        ];

        $url = "{$this->entity->getBaseUrl()}/auth/realms/{$this->entity->getRealm()}/protocol/openid-connect/logout";
        $response = $this->client->post($url, [
            'form_params' => $formParams
        ]);
        
        $response = json_decode((string) $response->getBody(), true);
        

        return $response;

    }

    // User Methods

    public function storeUser(User $user)
    {   
        try{

            $response = $this->client->post("{$this->entity->getUrl()}/{$this->entity->getRealm()}/users", 
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ],
                'json' => $user->toArray(),
            ]);

            $this->ApiLogout();

            return json_decode($response->getBody()->getContents());
            
        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
    }

    public function setUserPassword( String $userId, bool $isTemporary, String $password)
    {
        $response = $this->client->post("{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/{$userId}/reset-password", 
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

        $this->ApiLogout();

        return json_decode($response->getBody()->getContents());
    }
    

    public function getUser(String $userId)
    {
        try{
            
            $response = $this->client->get(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/{$userId}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );

            $this->ApiLogout();

            return json_decode($response->getBody()->getContents());
        
        }catch(\Exception $e){
                
            throw new \Exception($e->getMessage());
        }

    }

    public function getUsers() : Array
    {
        try{

            $response = $this->client->get(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );

            $this->ApiLogout();

            return json_decode($response->getBody()->getContents());

        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
    }

    public function updateUser(User $user, String $userId)
    {

        try{
            
            $response = $this->client->post("{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/{$userId}", 
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                    'Content-Type' => 'application/json'
                ],
                'json' => $user->toArray()
            ]);
            
            $this->ApiLogout();
            return json_decode($response->getBody()->getContents());

        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteUser(String $userId)
    {
        try{
            $response = $this->client->delete(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/users/{$userId}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
            $this->ApiLogout();
            return json_decode($response->getBody()->getContents());

        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
    }

    // Role Methods

    public function getRoles()
    {
        try{
            $response = $this->client->get(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
            $this->ApiLogout();
            return json_decode($response->getBody()->getContents());

        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
        
    }

    public function getRole(String $roleId)
    {
        try{
            $response = $this->client->get(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/{$roleId}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
            $this->ApiLogout();
            return json_decode($response->getBody()->getContents());

        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
        
    }

    public function storeRole(Role $role)
    {
        try{

            $response = $this->client->post(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ],
                    'json' => $role->toArray()
                ]
            );
            $this->ApiLogout();
    
            return json_decode($response->getBody()->getContents());

        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
    }

    public function updateRole(Role $role, String $roleName)
    {
        try{

            $response = $this->client->post(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/{$roleName}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ],
                    'json' => $role->toArray()
                ]
            );
            $this->ApiLogout();
            return json_decode($response->getBody()->getContents());

        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
        
    }
    

    public function deleteRole(String $roleName)
    {
        try{

            $response = $this->client->delete(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/roles/{$roleName}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
    
            $this->ApiLogout();
    
            return $response->getBody()->getContents();

        }catch(\Exception $e){
            
            throw new \Exception($e->getMessage());
        }
        
    }

    // Client Methods

    public function getClients()
    {
        try{
            $response = $this->client->get(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/clients/",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
    
            return $response->getBody()->getContents();

        }catch(\Exception $e){
                
            throw new \Exception($e->getMessage());
        }
    }

    // GROUPS METHODS

    public function getGroups()
    {
        try{
            $response = $this->client->get(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/groups/",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
    
            return $response->getBody()->getContents();

        }catch(\Exception $e){
                
            throw new \Exception($e->getMessage());
        }
    }

    public function getGroup(String $groupName)
    {
        try{
            $response = $this->client->get(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/groups/{$groupName}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
    
            return $response->getBody()->getContents();

        }catch(\Exception $e){
                
                throw new \Exception($e->getMessage());
        }
    }

    public function storeGroup(Group $group)
    {
        try{
            $response = $this->client->post(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/groups/",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ],
                    'json' => $group->toArray()
                ]
            );
    
            return $response->getBody()->getContents();

        }catch(\Exception $e){
                
            throw new \Exception($e->getMessage());
        }
    }

    public function updateGroup(Group $group, String $groupName)
    {
        try{
            $response = $this->client->post(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/groups/{$groupName}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ],
                    'json' => $group->toArray()
                ]
            );
    
            return $response->getBody()->getContents();

        }catch(\Exception $e){
                
            throw new \Exception($e->getMessage());
        }
    }
    
    public function deleteGroup(String $groupName)
    {
        try{
            $response = $this->client->delete(
                "{$this->entity->getBaseUrl()}{$this->entity->getBasePath()}/{$this->entity->getRealm()}/groups/{$groupName}",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->ApiAuthenticate(),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
    
            return $response->getBody()->getContents();

        }catch(\Exception $e){
                
            throw new \Exception($e->getMessage());
        }
    }

}

?>