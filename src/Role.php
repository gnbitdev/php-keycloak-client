<?php
namespace KeycloakApiClient;

class Role
{
    ## attributes
    private $name;
    private $description;

    ## constructor
    public function __construct($name=null, $description=null)
    {
        $this->name = $name;
        $this->description = $description;
    }

    ## getters and setters

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function toArray()
    {
        return array(
            'name' => $this->name,
            'description' => $this->description
        );
    }

}

?>