<?php

namespace Domain\Models\Entity;

interface CookingStepRepository
{
    /**
     * @return ?CookingStep
     */
    public function get($criteria);

    /**
     * @return CookingStep[]
     */
    public function list(array $criteria = [], array $sorting = null, int $page = 1);

    public function save(CookingStep $cookingStep): void;
}
