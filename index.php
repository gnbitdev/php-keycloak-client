<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use KeycloakApiClient\Rest;
use KeycloakApiClient\KeycloakApi;
use KeycloakApiClient\KeycloakApiEntity;
use KeycloakApiClient\Role;
use KeycloakApiClient\User;

$kce = new KeycloakApiEntity();

$kce->setBaseUrl('http://localhost:8080');
$kce->setBasePath('/auth/admin/realms');
$kce->setRealm('demo');
$kce->setClientId('rest-client');
$kce->setClientSecret('f7ad5791-60ea-4ed1-9aa7-afc5a977da75');
$kce->setGrantType('password');
$kce->setUsername('rest');
$kce->setPassword('123123123');

// $rest = new Rest($kce->toArray());

$guzzleClient = new Client;

$api = new KeycloakApi($kce, $guzzleClient);

# CREATE USER 

// $user = new User();
// $user->setUsername('Test');
// $user->setEnabled(true);
// $user->setTotp(false);
// $user->setEmailVerified(true);
// $user->setFirstName('Test');
// $user->setLastName('Test');
// $user->setEmail('joanjpx@github.com');
// $user->setAttributes(['test' => 'test']);

// $api->storeUser($user);


## CREATE ROLE

$role = new Role();
$role->setName('Test Role');
$role->setDescription('Test Role');

$api->storeRole($role);

##

?>