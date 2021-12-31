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
            self::subgroups( $data['subgroups'] ?? [] ),
            (object) $data['attributes']
        );
    }

    private static function subgroups(array $subgroups) : array
    {
        return array_map(function ($subgroup) {
            return self::make($subgroup);
        }, $subgroups);
    }
    
}