<?php

class KeycloakApiEntity
{
    /** Attributes */

    private $baseUrl;
    private $basePath;
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
    private $ApiClient;

    /**
     * KeycloakApi constructor.
     * @param $baseUrl
     * @param $clientId
     * @param $clientSecret
     * @param $realm
     * @param $username
     * @param $password
     */

    public function __construct($baseUrl=null, $basePath="/auth/admin/realms", $clientId=null, $clientSecret=null, $realm=null, $username=null, $password=null)
    {
        $this->baseUrl = $baseUrl;
        $this->basePath = $basePath;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->realm = $realm;
        $this->username = $username;
        $this->password = $password;
        $this->grandType = 'password';
    }

    public function toArray()
    {
        return [
            'baseUrl' => $this->getBaseUrl(),
            'basePath' => $this->getBasePath(),
            'clientId' => $this->getClientId(),
            'clientSecret' => $this->getClientSecret(),
            'grandType' => $this->getGrandType(),
            'realm' => $this->getRealm(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'token' => $this->getToken(),
            'refreshToken' => $this->getRefreshToken(),
            'accessToken' => $this->getAccessToken(),
            'expiresIn' => $this->getExpiresIn()            
        ];
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


    public function setBasePath(String $basePath) : void
    {
        $this->basePath = $basePath;
    }

    public function getBasePath() : String
    {
        return $this->basePath;
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

    public function setGrantType(String $grandType) : void
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


    
    

}