<?php

namespace KeycloakApiCLientIntegrationTest;

use KeycloakApiClient\Sdk;
use PHPUnit\Framework\TestCase;

class Sdktest extends TestCase
{

    private $provider;

    protected function setUp()
    {
       
    }

    public function testConnect()
    {

        self::assertInternalType('int', 1);
    }
}
