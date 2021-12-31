<?php
namespace KeycloakApiClient\Api\Entity;

class RoleFactory
{
    public static function make(array $data) : Role
    {
        return new Role(
            $data['id'],
            $data['name'],
            $data['description'],
            $data['attributes']
        );
    }
}