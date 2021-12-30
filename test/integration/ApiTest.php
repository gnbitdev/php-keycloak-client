<?php

namespace KeycloakApiCLientIntegrationTest;

use PHPUnit\Framework\TestCase;
use KeycloakApiClient\Api\Service\ApiService;
use KeycloakApiClient\Api\Entity\Connection;
use KeycloakApiClient\Api\Entity\Credentials;

class ApiTest extends TestCase
{

    private $clientApi;

    protected function setUp()
    {

        $credentials = new Credentials(
            getenv('kC_API_USERNAME'),
            getenv('kC_API_PASSWORD'),
            getenv('kC_API_GTYPE'),
            getenv('kC_API_CLIENT_ID'),
            getenv('kC_API_CLIENT_SECRET')
        );

        $conection = new Connection(
             getenv('kC_API_BASEURL'),
             getenv('kC_API_REALM'),
            $credentials
        );

        $this->clientApi = new ApiService ($conection);
    }

    public function testUsers()
    {
        $users = $this->clientApi->getUsers();

        //print_r($users);
        self::assertInternalType('int', 1);
    }

    public function testUser()
    {
        $user = $this->clientApi->getUser("08edcd2d-4c74-4873-842f-5b82ec4b05c5");

        print_r($user);
        self::assertInternalType('int', 1);
    }
}
