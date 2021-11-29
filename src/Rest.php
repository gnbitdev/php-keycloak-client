<?php
namespace KeycloakApiClient;

use Guzzle\Http\Client;

class Rest
{
    

    public function __construct()
    {
        $this->client = new Client();
        
    }

}

?>