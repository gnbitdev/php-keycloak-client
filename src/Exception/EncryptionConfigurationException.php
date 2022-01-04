<?php
declare(strict_types=1);

namespace KeycloakApiClient\Exception;

use Exception;

class EncryptionConfigurationException extends Exception
{
    /**
     * Returns properly formatted exception when response decryption fails.
     *
     * @return \KeycloakApiClient\Exception\EncryptionConfigurationException
     */
    public static function undeterminedEncryption()
    {
        return new static(
            'The given response may be encrypted and sufficient '.
            'encryption configuration has not been provided.',
            400
        );
    }
}