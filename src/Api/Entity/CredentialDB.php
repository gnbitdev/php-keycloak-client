<?php
declare(strict_types=1);

namespace KeycloakApiClient\Api\Entity;

use Alabra\Entity\EntityTrait;
use Alabra\Entity\EntityInterface;

class CredentialDB implements EntityInterface
{
    use EntityTrait;

    public function __construct(
        private string $host,
        private string $port,
        private string $database,
        private string $user,
        private string $password
    )
    {
        return $this;
    }
}
