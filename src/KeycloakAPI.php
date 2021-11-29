<?php

namespace KeycloakApiClient;


class KeycloakApi
{
    /** Attributes */

    private $baseUrl;
    private $clientId;
    private $clientSecret;
    private $grandType;
    private $realm;
    private $username;
    private $password;
    private $token;
    private $refreshToken;
    private $accessToken;
    private $expiresIn;

    /**
     * KeycloakApi constructor.
     * @param $baseUrl
     * @param $clientId
     * @param $clientSecret
     * @param $realm
     * @param $username
     * @param $password
     */

    public function __construct($baseUrl, $clientId, $clientSecret, $realm, $username, $password)
    {
        $this->baseUrl = $baseUrl;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->realm = $realm;
        $this->username = $username;
        $this->password = $password;
        $this->grandType = 'password';
    }


    /** Methods */

    // set Base Url
    public function setBaseUrl(String $baseUrl) : void
    {
        $this->baseUrl = $baseUrl;
    }

    // get Base Url
    public function getBaseUrl() : String
    {
        return $this->baseUrl;
    }

    // set Client Id

    public function setClientId(String $clientId) : void
    {
        $this->clientId = $clientId;
    }

    // get Client Id

    public function getClientId() : String
    {
        return $this->clientId;
    }

    // set Client Secret

    public function setClientSecret(String $clientSecret) : void
    {
        $this->clientSecret = $clientSecret;
    }

    // get Client Secret

    public function getClientSecret() : String
    {
        return $this->clientSecret;
    }

    // set Grand Type

    public function setGrandType(String $grandType) : void
    {
        $this->grandType = $grandType;
    }

    // get Grand Type

    public function getGrandType() : String
    {
        return $this->grandType;
    }

    // set Realm

    public function setRealm(String $realm) : void
    {
        $this->realm = $realm;
    }

    // get Realm

    public function getRealm() : String
    {
        return $this->realm;
    }

    // set Username

    public function setUsername(String $username) : void
    {
        $this->username = $username;
    }

    // get Username

    public function getUsername() : String
    {
        return $this->username;
    }

    // set Password

    public function setPassword(String $password) : void
    {
        $this->password = $password;
    }

    // get Password

    public function getPassword() : String
    {
        return $this->password;
    }

    // set Token

    public function setToken(String $token) : void
    {
        $this->token = $token;
    }

    // get Token

    public function getToken() : String
    {
        return $this->token;
    }

    // set Refresh Token

    public function setRefreshToken(String $refreshToken) : void
    {
        $this->refreshToken = $refreshToken;
    }

    // get Refresh Token

    public function getRefreshToken() : String
    {
        return $this->refreshToken;
    }

    // set Access Token

    public function setAccessToken(String $accessToken) : void
    {
        $this->accessToken = $accessToken;
    }

    // get Access Token

    public function getAccessToken() : String
    {
        return $this->accessToken;
    }

    // set Expires In

    public function setExpiresIn(String $expiresIn) : void
    {
        $this->expiresIn = $expiresIn;
    }

    // get Expires In

    public function getExpiresIn() : String
    {
        return $this->expiresIn;
    }


    public function authenticate()
    {


    }

    // API Methods from Postman Collection @ Keycloak API REST

    // Get all users

    public function getUsers()
    {

    }

    // Get user by id

    public function getUserById( String $userId)
    {

    }

    // Create user

    public function createUser( Array $user )
    {

    }
    

    // Update user

    public function updateUser(Array $user)
    {

    }
    

    // Delete user

    public function deleteUser()
    {

    }

    // Get all roles

    public function getRoles()
    {

    }

    // Get role by name

    public function getRoleByName()
    {

    }

    // Create role

    public function createRole(Array $role)
    {
        
    }

}





?>