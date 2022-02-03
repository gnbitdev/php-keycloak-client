<?php
declare(strict_types=1);

namespace KeycloakApiClient\Api\Entity;

use Alabra\Entity\EntityTrait;
use Alabra\Entity\EntityInterface;

class Credentials implements EntityInterface
{
    use EntityTrait;

    protected $username;
    protected $password;
    protected $grandType;
    protected $clientId;
    protected $clientSecret;
    protected $token;

    /**
     *
     * @param string $username
     * @param string $password
     * @param string $grandType
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(
        string $username,
        string $password,
        string $grandType,
        string $clientId,
        string $clientSecret
    )
    {
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
        $this->username     = $username;
        $this->password     = $password;
        $this->grandType    = $grandType;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'username'      => $this->username,
            'password'      => $this->password,
            'grant_type'    => $this->grandType,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }
}
