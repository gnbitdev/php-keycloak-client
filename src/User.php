<?php
namespace KeycloakApiClient;

class User 
{
    private $username;
    private $enabled;
    private $totp;
    private $emailVerified;
    private $firstName;
    private $lastName;
    private $email;
    private $attributes;

    public function __construct()
    {
        
    }

    // Getters y Setters
    
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function getTotp()
    {
        return $this->totp;
    }

    public function setTotp($totp)
    {
        $this->totp = $totp;
    }

    public function getEmailVerified()
    {
        return $this->emailVerified;
    }

    public function setEmailVerified($emailVerified)
    {
        $this->emailVerified = $emailVerified;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function getAttribute($attributeName)
    {
        return $this->attributes[$attributeName];
    }

    public function setAttribute($attributeName, $attributeValue)
    {
        $this->attributes[$attributeName] = $attributeValue;
    }

    public function getAttributeValue($attributeName)
    {
        return $this->attributes[$attributeName][0];
    }

    public function setAttributeValue($attributeName, $attributeValue)
    {
        $this->attributes[$attributeName][0] = $attributeValue;
    }

    


}