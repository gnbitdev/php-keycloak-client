<?php
namespace KeycloakApiClient\Api\Entity;

use Alabra\Entity\EntityTrait;
use Alabra\Entity\EntityInterface;

class Role implements EntityInterface
{
    use EntityTrait;

    ## attributes
    public $id;
    private $name;
    private $description;
    private $attributes;

    ## constructor
    public function __construct(
        string $id, 
        string $name, 
        string $description, 
        array $attributes
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->attributes = $attributes;
    }

    public function toArray() : Array
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'attributes' => (Object)$this->attributes
        );
    }

}

?>