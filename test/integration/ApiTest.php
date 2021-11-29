<?php

namespace KeycloakApiCLientIntegrationTest;

use PHPUnit\Framework\TestCase;
use KeycloakApiClient\Rest;

class Apitest extends TestCase
{

    protected function setUp()
    {
        
    }

    public function testConnect()
    {
        $rest = new Rest();

        self::assertInternalType('int', 1);
    }
}
