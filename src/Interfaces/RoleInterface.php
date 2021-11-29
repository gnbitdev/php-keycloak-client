<?php

namespace KeycloakApiClient\Interfaces;

interface RoleInterface
{

    public function getName();

    public function setName($name);

    public function getDescription();

    public function setDescription($description);
}
