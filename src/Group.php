<?php
namespace KeycloakApiClient;

class Group
{

    private $id;
    private $name;
    private $path;
    private $subgroups;

    public function __construct(String $id='', String $name='', String $path='', Array $subgroups=[], Array $attributes=[])
    {
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
        $this->subgroups = $subgroups;
        $this->attributes = $attributes;
    }
    

    public function getId() : String
    {
        return $this->id;
    }
    
    public function getName() : String
    {
        return $this->name;
    }

    public function getPath() : String
    {
        return $this->path;
    }

    public function getSubgroups() : Array
    {
        return $this->subgroups;
    }

    public function setName(String $name) : void
    {
        $this->name = $name;
    }

    public function setPath(String $path) : void
    {
        $this->path = $path;
    }

    public function setSubgroups(Array $subgroups) : void
    {
        $this->subgroups = $subgroups;
    }

    public function getAttributes() : Array
    {
        return $this->attributes;
    }

    public function setAttributes(Array $attributes) : void
    {
        $this->attributes = $attributes;
    }

    public function toArray() : Array
    {
        $subGroups = [];

        foreach($this->subgroups as $subgroup) {
            $subGroups[] = (Object)$subgroup;
        }

        return [
            'id' => empty($this->id) ? null : $this->id,
            'name' => $this->name,
            'path' => $this->path,
            'subGroups' => $subGroups,
            'attributes' => (Object)$this->attributes
        ];
    }
}