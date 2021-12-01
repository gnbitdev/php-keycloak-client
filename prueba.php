<?php

// print_r("Hello");exit;
require 'vendor/autoload.php';
$config = [
    "authServerUrl" => "http://192.168.10.78:6030/auth", // The authorization server URL where is Keycloak running
    "realm" => "demo", // the realm you're using on KC
    "clientId" => "js-console" // the client ID you're using on KC
];
// print_r($config);
// exit;
session_id("keycloakSession");
session_start();



// print_r($_SESSION);exit;
/*{
  "realm" : "demo",
  "auth-server-url" : "http://localhost:8080/auth",
  "resource" : "js-console"
}
 */
$provider = new KeycloakApiClient\Keycloak(
    $config
);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();

    // print_r("ASDASDASDASD");exit;
    header('Location: '.$authUrl);
    exit;

} else {

    // Try to get an access token (using the authorization coe grant)
    try {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
    } catch (Exception $e) {
        exit('Failed to get access token: '.$e->getMessage());
    }

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);

        // Use these details to create a new profile
        $_SESSION['Zend_Auth']['user'] = $user->toArray();
        $_SESSION['Zend_Auth']['access_token'] = $token->getToken();
        $_SESSION['Zend_Auth']['refresh_token'] = $token->getRefreshToken();
        $_SESSION['Zend_Auth']['user_logged'] = $user->getName();
        $_SESSION['Zend_Auth']['user_info'] = (array)json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
        $_SESSION['Zend_Auth']['roles'] = $_SESSION['Zend_Auth']['user_info']['realm_access']->roles;
        // session_destroy();

        print_r($_SESSION);exit;
        header('Location: http://checklist.test/');


    } catch (Exception $e) {
        exit('Failed to get resource owner: '.$e->getMessage());
    }

    // Use this to interact with an API on the users behalf
    // echo $token->getToken();
}