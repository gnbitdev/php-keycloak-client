<?php
declare(strict_types=1);

namespace KeycloakApiClient\Api\Entity;

class RoleFactory
{

    public static function make(array $data): Role
    {
        return new Role(
            $data['id'],
            $data['name'] ?? '',
            !empty($data['description']) ? $data['description'] : '',
            $data['attributes'] ?? []
        );
    }
}
