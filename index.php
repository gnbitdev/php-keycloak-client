<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use KeycloakApiClient\Rest;
use KeycloakApiClient\KeycloakApi;
use KeycloakApiClient\KeycloakApiEntity;
use KeycloakApiClient\Role;
use KeycloakApiClient\User;
use KeycloakApiClient\Group;

$kce = new KeycloakApiEntity();

$kce->setBaseUrl('http://localhost:8080');
$kce->setBasePath('/auth/admin/realms');
$kce->setRealm('demo');
$kce->setClientId('rest-client');
$kce->setClientSecret('1bff5bad-6a18-4bb6-82f9-5a4f97644a5a');
$kce->setGrantType('password');
$kce->setUsername('rest');
$kce->setPassword('123123123');

// $rest = new Rest($kce->toArray());

$guzzleClient = new Client;

$api = new KeycloakApi($kce, $guzzleClient);

# CREATE USER 

$user = new User();
$user->setUsername('Test4');
$user->setEnabled(true);
$user->setTotp(false);
$user->setEmailVerified(true);
$user->setFirstName('Test4');
$user->setLastName('Test4');
$user->setEmail('joanjpx4@github.com');
$user->setAttributes(['test4' => 'test4']);

$api->storeUser($user);

## GET USERS

print_r(
    $api->getUsers()
);
exit;



## CREATE ROLE

// $role = new Role();
// $role->setName('Test Role3');
// $role->setDescription('Test Role2');

// $api->storeRole($role);

##

?>