<?php

namespace KeycloakApiClient;

use GuzzleHttp\Client;
use KeycloakApiClient\Rest;
use KeycloakApiEntity;

class KeycloakApi
{
    private $entity;

    public function __construct(KeycloakApiEntity $keycloakApiEntity, Client $client)
    {
        $this->entity = $keycloakApiEntity;
        $this->client = $client;
    }

    public function storeUser(User $user)
    {   
        $response = $this->client->post();

        return $response->getBody()->getContents();
    }


}





?>