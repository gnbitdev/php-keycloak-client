<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use KeycloakApiClient\Rest;
use KeycloakApiClient\KeycloakApi;


$kce = new KeycloakApiEntity();




$kce->setBaseUrl('http://localhost:8080');
$kce->setBasePath('/auth/admin/realms');
$kce->setRealm('demo');
$kce->setClientId('rest-client');
$kce->setClientSecret('950b8a78-319b-4897-b926-11ec197bce79');
$kce->setGrantType('password');
$kce->setUsername('rest');
$kce->setPassword('123123123');

$rest = new Rest($kce->toArray());

$guzzleClient = new Client;

$api = new KeycloakApi($kce, $guzzleClient);




?>