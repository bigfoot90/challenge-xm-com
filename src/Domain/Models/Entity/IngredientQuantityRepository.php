<?php

namespace Domain\Models\Entity;

interface IngredientQuantityRepository
{
    /**
     * @return ?IngredientQuantity
     */
    public function get($criteria);

    /**
     * @return IngredientQuantity[]
     */
    public function list(array $criteria = [], array $sorting = null, int $page = 1);

    public function save(IngredientQuantity $quantity): void;
}
