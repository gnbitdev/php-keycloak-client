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
    private $realmRoles;

    public function __construct(
        String $username='',
        String $enabled='',
        String $totp='',
        String $emailVerified='',
        String $firstName='',
        String $lastName='',
        String $email='',
        Array $attributes=[]
    )
    {
        $this->username = $username;
        $this->enabled = $enabled;
        $this->totp = $totp;
        $this->emailVerified = $emailVerified;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->attributes = $attributes;
        $this->realmRoles = [];
    }

    // Getters y Setters

    public function getUsername() : String
    {
        return $this->username;
    }

    public function setUsername($username) : void
    {
        $this->username = $username;
    }

    public function getEnabled() : String
    {
        return $this->enabled;
    }

    public function setEnabled($enabled) : void
    {
        $this->enabled = $enabled;
    }

    public function getTotp() : String
    {
        return $this->totp;
    }

    public function setTotp($totp) : void
    {
        $this->totp = $totp;
    }

    public function getEmailVerified() : String
    {
        return $this->emailVerified;
    }

    public function setEmailVerified($emailVerified) : void
    {
        $this->emailVerified = $emailVerified;
    }

    public function getFirstName() : String
    {
        return $this->firstName;
    }

    public function setFirstName($firstName) : void
    {
        $this->firstName = $firstName;
    }

    public function getLastName() : String
    {
        return $this->lastName;
    }

    public function setLastName($lastName) : void
    {
        $this->lastName = $lastName;
    }

    public function getEmail() : String
    {
        return $this->email;
    }

    public function setEmail($email) : void
    {
        $this->email = $email;
    }

    public function getAttributes() : Array
    {
        return $this->attributes;
    }

    public function setAttributes($attributes) : void
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


    public function getRealmRoles() : Array
    {
        return $this->realmRoles;
    }

    public function setRealmRoles(Array $realmRoles) : void
    {
        $this->realmRoles = $realmRoles;
    }


    public function toArray() : Array
    {
        $array = array();

        $array['username'] = $this->username;
        $array['enabled'] = $this->enabled;
        $array['totp'] = $this->totp;
        $array['emailVerified'] = $this->emailVerified;
        $array['firstName'] = $this->firstName;
        $array['lastName'] = $this->lastName;
        $array['email'] = $this->email;
        $array['attributes'] = $this->attributes;
        $array['realmRoles'] = $this->realmRoles;

        return $array;
    }


}
