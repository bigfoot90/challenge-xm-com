<?php

namespace Domain\Models\Entity;

interface RecipeRepository
{
    /**
     * @return ?Recipe
     */
    public function get($criteria);

    /**
     * @return Recipe[]
     */
    public function list(array $criteria = [], array $sorting = null);

    public function save(Recipe $recipe): void;
}
