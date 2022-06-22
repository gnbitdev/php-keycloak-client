<?php
declare(strict_types=1);

namespace KeycloakApiClient;

use KeycloakApiClient\Api\Entity\CredentialDB;

class DB
{
    public function __construct(
        private CredentialDB $credential
    )
    {
        // PDO postgres
        $this->db = new \PDO(
            'pgsql:host='.$credential->host.';port='.$credential->port.';dbname='.$credential->database,
            $credential->user,
            $credential->password
        );
    }


    public function getConnection(): \PDO
    {
        return $this->db;
    }    
}
