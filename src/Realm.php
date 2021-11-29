<?php

class Realm
{

    private $realmName;

    # constructor

    public function __construct($realmName)
    {
        $this->realmName = $realmName;
    }

    # getters

    public function getRealmName()
    {
        return $this->realmName;
    }

    # setters

    public function setRealmName($realmName)
    {
        $this->realmName = $realmName;
    }
}

?>