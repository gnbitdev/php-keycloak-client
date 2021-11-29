<?php
require_once 'vendor/autoload.php';

use KeycloakApiClient\Rest;
use KeycloakApiClient\KeycloakApi;

$kc = new KeycloakApi();

$kc->setBaseUrl('http://localhost:8080');
$kc->setRealm('demo');
$kc->setClientId('rest-client');
$kc->setClientSecret('950b8a78-319b-4897-b926-11ec197bce79');
$kc->setGrantType('password');
$kc->setUsername('rest');
$kc->setPassword('123123123');

$REST = $kc->getApiClient();

print_r($REST);exit;



?>