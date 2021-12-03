<?php
namespace KeycloakApiClient;

class Role
{
    ## attributes
    public $id;
    private $name;
    private $description;

    ## constructor
    public function __construct($id='', $name='', $description='')
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    ## getters and setters
    public function getId() : String
    {
        return $this->id;
    }

    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function getName() : String
    {
        return $this->name;
    }

    public function setName(String $name)
    {
        $this->name = $name;
    }

    public function getDescription() : String
    {
        return $this->description;
    }

    public function setDescription(String $description)
    {
        $this->description = $description;
    }

    public function toArray() : Array
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description
        );
    }

}

?>