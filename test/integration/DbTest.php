<?php

namespace KeycloakApiCLientIntegrationTest;

use PHPUnit\Framework\TestCase;
use KeycloakApiClient\Api\Entity\CredentialDB;
use KeycloakApiClient\Api\Service\DbService;
use KeycloakApiClient\DB;

class DbTest extends TestCase
{

    private $client;

    const UNIQUE_ID = 465563;

    protected function setUp()
    {
        
        $credentials = new CredentialDB(
            getenv('kC_DB_HOST'),
            getenv('kC_DB_PORT'),
            getenv('kC_DB_NAME'),
            getenv('kC_DB_USER'),
            getenv('kC_DB_PASS')
        );

        $conection = new DB(
            $credentials
        );

        $this->client = new DbService($conection, getenv('kC_DB_REALM'));
    }



    // tests

    public function testGroupsByUsers()
    {

        $groups = $this->client->groupsByUsers();

        self::assertIsArray($groups);
    }


    public function testRolesByUsers()
    {
        $roles = $this->client->rolesByUsers();

        // print_r($roles);

        self::assertIsArray($roles);
    }


    public function testSyncRolesOnUser()
    {
        $sync = $this->client->syncRolesOnUser(
            [
                'Analista',
                'Administrador'
            ],
            'e9ee390a-50ff-415d-9c69-cf034cd59e56'
        );

        // assert if true
        self::assertTrue($sync);
    }


    public function testSyncGroupsOnUser()
    {
        $sync = $this->client->syncGroupsOnUser(
            [
                'grupo1'
            ],
            'e9ee390a-50ff-415d-9c69-cf034cd59e56'
        );

        // assert if true
        self::assertTrue($sync);
    }
    
}
