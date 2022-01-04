<?php
declare(strict_types=1);

namespace KeycloakApiClient\Api\Entity;

use Alabra\Entity\EntityTrait;
use Alabra\Entity\EntityInterface;
use KeycloakApiClient\Api\Entity\Credentials;

class Connection implements EntityInterface
{
    use EntityTrait;

    private $baseUrl;
    private $realm;
    private $credentials;

    public function __construct(
        string $baseUrl,
        string $realm,
        Credentials $credentials
    )
    {
        $this->baseUrl     = $baseUrl;
        $this->realm       = $realm;
        $this->credentials = $credentials;

        return $this;
    }
}
