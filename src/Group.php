<?php
namespace KeycloakApiClient;

class Group
{

    private $id;
    private $name;
    private $path;
    private $subgroups;

    public function __construct($id='', $name='', $path='', $subgroups='')
    {
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
        $this->subgroups = $subgroups;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getSubgroups()
    {
        return $this->subgroups;
    }

    public function setName(String $name)
    {
        $this->name = $name;
    }

    public function setPath(String $path)
    {
        $this->path = $path;
    }

    public function setSubgroups(Array $subgroups)
    {
        $this->subgroups = $subgroups;
    }

    public function toArray() : Array
    {
        return [
            'name' => $this->name,
            'path' => $this->path,
            'subgroups' => $this->subgroups
        ];
    }
}