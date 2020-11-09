<?php

namespace Infrastructure\Persistence\Mysql;

use Domain\Models\Entity\Ingredient;
use Domain\Models\Entity\IngredientRepository;

class IngredientMysqlRepository extends AbstractMysqlRepository implements IngredientRepository
{
    protected string $entityClassname = Ingredient::class;
}
