<?php
namespace KeycloakApiClient\Api\Entity;

use Alabra\Entity\EntityTrait;
use Alabra\Entity\EntityInterface;

class Group implements EntityInterface
{
    use EntityTrait;

    private $id;
    private $name;
    private $path;
    private $subgroups;
    private $attributes;

    public function __construct(
        string $id,
        string $name,
        string $path,
        array $subgroups,
        array $attributes
    )
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->path       = $path;
        $this->subgroups  = $subgroups;
        $this->attributes = $attributes;
    }

    public function toArray(): Array
    {
        $subGroups = [];

        foreach ($this->subgroups as $subgroup) {
            $subGroups[] = (Object) $subgroup;
        }

        return [
            'id'         => empty($this->id) ? null : $this->id,
            'name'       => $this->name,
            'path'       => $this->path,
            'subGroups'  => $subGroups,
            'attributes' => (Object) $this->attributes
        ];
    }
}
