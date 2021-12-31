<?php

namespace KeycloakApiCLientIntegrationTest;

use PHPUnit\Framework\TestCase;
use KeycloakApiClient\Api\Service\ApiService;
use KeycloakApiClient\Api\Entity\Connection;
use KeycloakApiClient\Api\Entity\Credentials;

class ApiTest extends TestCase
{

    private $clientApi;
    private $userIds = [];

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

        $this->clientApi = new ApiService($conection);
    }

    public function testUsers()
    {
        $users = $this->clientApi->getUsers();
        foreach ($users as $user) {
            self::assertIsObject($user);
            self::assertInternalType('string', $user->id);

            $data = $this->clientApi->getUser($user->id);
            self::assertIsObject($data);
        }

        self::assertIsArray($users);
    }

    public function xtestDipslayUsers()
    {
        $users = $this->clientApi->getUsers();
        fwrite(STDERR, print_r($users, TRUE));

        self::assertInternalType('int', 1);
    }

    public function xtestDipslayUser()
    {
        $user = $this->clientApi->getUser("a2a6a4ab-0ee5-4213-8942-31aee4c81f48");
        fwrite(STDERR, print_r($user, TRUE));

        self::assertInternalType('int', 1);
    }


     public function xtestDipslayUser()
    {
        $user = $this->clientApi->getUser("a2a6a4ab-0ee5-4213-8942-31aee4c81f48");
        fwrite(STDERR, print_r($user, TRUE));

        self::assertInternalType('int', 1);
    }


}
