<?php

namespace Domain\Models\Entity;

use Domain\Models\ValueObject\Id;

class Ingredient
{
    private Id $id;
    private string $name;
    private string $kind;

    public function __construct(string $name, string $kind)
    {
        $this->id = new Id();
        $this->update($name, $kind);
    }

    public function update(string $name, string $kind): void
    {
        $this->name = ucfirst(strtolower($name));
        $this->kind = ucfirst(strtolower($kind));
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKind(): string
    {
        return $this->kind;
    }
}
