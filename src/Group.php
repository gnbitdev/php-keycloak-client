<?php
namespace KeycloakApiClient;

class Group
{

    private $name;
    private $path;
    private $subgroups;

    public function __construct($name='', $path='', $subgroups='')
    {
        $this->name = $name;
        $this->path = $path;
        $this->subgroups = $subgroups;
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