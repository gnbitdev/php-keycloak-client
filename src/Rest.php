<?php
namespace KeycloakApiClient;

use GuzzleHttp\Client;

class Rest
{
    private $client;
    private $KeycloakClient;


    public function __construct(KeycloakApi $KeycloakClient)
    {
        
        $this->client = new Client();
        $this->config = $KeycloakClient;
    }

    public function ApiAuthenticate()
    {
        $this->baseUrl = "http://localhost:8080/auth/realms/{$this->config->getRealm()}/protocol/openid-connect/token";
        $response = $this->client->post($this->baseUrl, [
            'form_params' => [
                'username' => $this->config->getUsername(),
                'password' => $this->config->getPassword(),
                'grant_type' => 'password',
                'client_id' => $this->config->getClientId(),
                'client_secret' => $this->config->getClientSecret(),
            ]
        ]);
        
        $response = json_decode((string) $response->getBody(), true);
        
        return $response;

    }

    public function ApiGet($url)
    {
        $response = $this->client->get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate()['access_token']
            ]
        ]);
        $response = json_decode((string) $response->getBody(), true);

        return $response;
    }

    public function ApiPost($url, $data)
    {
        $response = $this->client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate()['access_token']
            ],
            'json' => $data
        ]);
        $response = json_decode((string) $response->getBody(), true);

        return $response;
    }

    public function ApiPut($url, $data)
    {
        $response = $this->client->put($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate()['access_token']
            ],
            'json' => $data
        ]);
        $response = json_decode((string) $response->getBody(), true);

        return $response;
    }

    public function ApiDelete($url)
    {
        $response = $this->client->delete($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate()['access_token']
            ]
        ]);
        $response = json_decode((string) $response->getBody(), true);

        return $response;
    }

    public function ApiPatch($url, $data)
    {
        $response = $this->client->patch($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate()['access_token']
            ],
            'json' => $data
        ]);
        $response = json_decode((string) $response->getBody(), true);

        return $response;
    }

    public function ApiHead($url)
    {
        $response = $this->client->head($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->ApiAuthenticate()['access_token']
            ]
        ]);
        $response = json_decode((string) $response->getBody(), true);

        return $response;
    }

    
    






}

?>