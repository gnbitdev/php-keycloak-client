<?php

namespace KeycloakApiCLientIntegrationTest;

use PHPUnit\Framework\TestCase;
use KeycloakApiClient\Api\Service\ApiService;
use KeycloakApiClient\Api\Entity\Connection;
use KeycloakApiClient\Api\Entity\Credentials;
use KeycloakApiClient\Api\Entity\User;

class ApiTest extends TestCase
{

    private $clientApi;

    const UNIQUE_ID = 6661;

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

    public function xtestUsers()
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

    public function xtestDisplayUsers()
    {
        $users = $this->clientApi->getUsers();
        fwrite(STDERR, print_r($users, TRUE));

        self::assertInternalType('int', 1);
    }

    public function xtestDisplayUser()
    {
        $user = $this->clientApi->getUser("a2a6a4ab-0ee5-4213-8942-31aee4c81f48");
        fwrite(STDERR, print_r($user, TRUE));

        self::assertInternalType('int', 1);
    }

    public function testCreateUser()
    {
        
        $user = [
            'username' => 'test_user_' . self::UNIQUE_ID,
            'email' => 'test_user_' . self::UNIQUE_ID . '@example.com',
            'firstName' => 'Test',
            'lastName' => 'User',
            'enabled' => true,
            'totp' => false,
            'attributes' => [
                'phone' => '+1-555-555-5555',
                'address' => '123 Main St.',
                'city' => 'Anytown',
                'state' => 'CA',
                'zip' => '12345',
                'country' => 'US',
            ],
        ];
        
        $res = $this->clientApi->createUser($user);

        self::assertIsObject($res);
        self::assertInstanceOf(User::class, $res);

    }
    
    public function testGetUserByUsername()
    {
        $user = $this->clientApi->getUserByUsername('test_user_' . self::UNIQUE_ID);
        self::assertIsObject($user);
        self::assertInstanceOf(User::class, $user);
    }

    public function testUpdateUser()
    {
        $user = $this->clientApi->getUserByUsername('test_user_' . self::UNIQUE_ID);
        $update = $user->toArray();
        $res = $this->clientApi->updateUser($update, $user->id);
        self::assertIsObject($res);
        self::assertInstanceOf(User::class, $res);

    }

    public function testToggleUserEnabled()
    {
        $user = $this->clientApi->getUserByUsername('test_user_' . self::UNIQUE_ID);
        
        $res = $this->clientApi->toggleUserEnabled($user->id, true);

        self::assertTrue($res);
    }

    public function testDeleteUser()
    {
        
        $user = $this->clientApi->getUserByUsername('test_user_' . self::UNIQUE_ID);
        $res = $this->clientApi->deleteUser($user->id);
        self::assertTrue($res);

    }

    /**GROUP TESTS */

    public function testCreateGroup()
    {
        
        $group = [
            'name' => 'test_group_' . self::UNIQUE_ID,
            'attributes' => [
                'phone' => '+1-555-555-5555',
                'address' => '123 Main St.',
                'city' => 'Anytown',
                'state' => 'CA',
                'zip' => '12345',
                'country' => 'US',
            ],
        ];
        
        $res = $this->clientApi->createGroup($group);

        self::assertIsObject($res);
        self::assertInstanceOf(Group::class, $res);

    }

    public function testGetGroups()
    {
        $groups = $this->clientApi->getGroups();
        foreach ($groups as $group) {
            self::assertIsObject($group);
            self::assertInternalType('string', $group->id);

            $data = $this->clientApi->getGroup($group->id);
            self::assertIsObject($data);
        }

        self::assertIsArray($groups);
    }


    public function testGetGroup()
    {
        $group = $this->clientApi->getGroup("test_group_" . self::UNIQUE_ID);
        self::assertIsObject($group);
        self::assertInstanceOf(Group::class, $group);
    }

    public function testUpdateGroup()
    {
        $group = $this->clientApi->getGroupByName("test_group_" . self::UNIQUE_ID);
        $update = $group->toArray();
        
        $res = $this->clientApi->updateGroup($update, $group->id);
    
        self::assertIsObject($res);
        self::assertInstanceOf(Group::class, $res);
    
    }

    public function testDeleteGroup()
    {
        $group = $this->clientApi->getGroupByName("test_group_" . self::UNIQUE_ID);
        $res = $this->clientApi->deleteGroup($group->id);
    
        self::assertTrue($res);
    }

    /**ROLE TESTS */

    public function testCreateRole()
    {
        $role = [
            'name' => 'test_role_' . self::UNIQUE_ID,
            'description' => 'test_role_' . self::UNIQUE_ID,
            'attributes' => [
                'phone' => '+1-555-555-5555',
                'address' => '123 Main St.',
                'city' => 'Anytown',
                'state' => 'CA',
                'zip' => '12345',
                'country' => 'US',
            ],
        ];
        
        $res = $this->clientApi->createRole($role);
    
        self::assertIsObject($res);
        self::assertInstanceOf(Role::class, $res);
    
    }

    public function testGetRoles()
    {
        $roles = $this->clientApi->getRoles();
        foreach ($roles as $role) {
            self::assertIsObject($role);
            self::assertInternalType('string', $role->id);
    
            $data = $this->clientApi->getRole($role->id);
            self::assertIsObject($data);
        }
    
        self::assertIsArray($roles);
    }

    public function testGetRole()
    {
        $role = $this->clientApi->getRole("test_role_" . self::UNIQUE_ID);
        self::assertIsObject($role);
        self::assertInstanceOf(Role::class, $role);
    }

    public function testUpdateRole()
    {
        $role = $this->clientApi->getRole("test_role_" . self::UNIQUE_ID);
        $update = $role->toArray();
        
        $res = $this->clientApi->updateRole($update, $role->id);
    
        self::assertIsObject($res);
        self::assertInstanceOf(Role::class, $res);
    
    }

    public function testDeleteRole()
    {
        
        $role = $this->clientApi->getRole("test_role_" . self::UNIQUE_ID);
        $res = $this->clientApi->deleteRole($role->id);
    
        self::assertTrue($res);
    
    }

}
