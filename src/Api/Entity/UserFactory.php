<?php
namespace KeycloakApiClient\Api\Entity;
class UserFactory
{

    public static function make(array $item): User
    {
        return new User(
            $item['id'] ?? null,
            $item['username'],
            (bool) $item['enabled'],
            (bool) $item['totp'],
            (bool) $item['emailVerified'],
            $item['firstName'] ?? null,
            $item['lastName'] ?? null,
            $item['email'],
            $item['attributes'] ?? [],
            $item['access'] ?? []
        );
    }
}
