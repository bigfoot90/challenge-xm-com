<?php

namespace Domain\Models\Entity;

interface IngredientRepository
{
    /**
     * @return ?Ingredient
     */
    public function get($criteria);

    /**
     * @return Ingredient[]
     */
    public function list(array $criteria = [], array $sorting = null, int $page = 1);

    public function save(Ingredient $ingredient): void;
}
