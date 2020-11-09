<?php

namespace Domain\Models\Entity;

interface ChefRepository
{
    /**
     * @return ?Chef
     */
    public function get($criteria);

    /**
     * @return Chef[]
     */
    public function list(array $criteria = [], array $sorting = null);

    public function save(Chef $chef): void;
}
