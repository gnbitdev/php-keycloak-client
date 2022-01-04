<?php
declare(strict_types=1);

namespace KeycloakApiClient\Api\Entity;

use Alabra\Entity\EntityTrait;
use Alabra\Entity\EntityInterface;

class User implements EntityInterface
{
    use EntityTrait;

    /**
     *
     * @var string
     */
    protected $username;

    /**
     *
     * @var bool
     */
    protected $enabled;

    /**
     *
     * @var bool
     */
    protected $totp;

    /**
     *
     * @var bool
     */
    protected $emailVerified;

    /**
     *
     * @var string
     */
    protected $firstName;

    /**
     *
     * @var string
     */
    protected $lastName;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var array
     */
    protected $attributes;

    /**
     *
     * @var array
     */
    protected $access;

    /**
     *
     * @param string $id
     * @param string $username
     * @param bool $enabled
     * @param bool $totp
     * @param bool $emailVerified
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param array $attributes

     */
    public function __construct(
        string $id,
        string $username,
        bool $enabled,
        bool $totp,
        bool $emailVerified,
        string $firstName,
        string $lastName,
        string $email,
        array $attributes,
        array $access
    )
    {
        $this->id            = $id;
        $this->username      = $username;
        $this->enabled       = $enabled;
        $this->totp          = $totp;
        $this->emailVerified = $emailVerified;
        $this->firstName     = $firstName;
        $this->lastName      = $lastName;
        $this->email         = $email;
        $this->attributes    = $attributes;
        $this->access        = $access;
    }
}
