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
            self::subgroups( !empty($data['subGroups']) ? $data['subGroups'] : [] ),
            !empty($data['attributes']) ? (object)$data['attributes'] : (object)[]
        );
    }

    private static function subgroups(array $subgroups) : array
    {
        return array_map(function ($subgroup) {
            return self::make($subgroup);
        }, $subgroups);
    }
    
}