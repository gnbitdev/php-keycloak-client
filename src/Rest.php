<?php
namespace KeycloakApiClient;

//use Guzzle\Http\Client;
use GuzzleHttp\Client;

class Rest
{


    public function __construct()
    {
        $this->client = new Client();

    }

}

?>