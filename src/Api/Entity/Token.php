<?php
declare(strict_types=1);

namespace KeycloakApiClient\Api\Entity;

use Alabra\Entity\EntityTrait;
use Alabra\Entity\EntityInterface;

class Token implements EntityInterface
{
    use EntityTrait;

    protected $accessToken;
    protected $expiresIn;
    protected $refreshExpiresIn;
    protected $refreshToken;
    protected $tokenType;
    protected $notBeforePolicy;
    protected $scope;

    /**
     *
     * @param string $accessToken
     * @param int $expiresIn
     * @param int $refreshExpiresIn
     * @param string $refreshToken
     * @param string $tokenType
     * @param string $notBeforePolicy
     * @param string $notBeforePolicy
     * @param string $scope
     */
    public function __construct(
        string $accessToken,
        int $expiresIn,
        int $refreshExpiresIn,
        string $refreshToken,
        string $tokenType,
        string $notBeforePolicy,
        string $scope
    )
    {
        $this->accessToken      = $accessToken;
        $this->expiresIn        = $expiresIn;
        $this->refreshExpiresIn = $refreshExpiresIn;
        $this->refreshToken     = $refreshToken;
        $this->tokenType        = $tokenType;
        $this->notBeforePolicy  = $notBeforePolicy;
        $this->scope            = $scope;
    }
}
