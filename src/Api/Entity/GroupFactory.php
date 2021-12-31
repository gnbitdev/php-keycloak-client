<?php
namespace KeycloakApiClient\Api\Entity;

class GroupFactory
{
    public static function make(array $data) : Group
    {
        return new Group(
            $data['id'],
            $data['name'],
            $data['path'],
            $data['subgroups'] ?? [],
            $data['attributes'] ?? []
        );
    }
}