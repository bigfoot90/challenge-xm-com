<?php

namespace Infrastructure\Persistence\Mysql;

use Domain\Models\Entity\IngredientQuantity;
use Domain\Models\Entity\IngredientQuantityRepository;

class IngredientQuantityMysqlRepository extends AbstractMysqlRepository implements IngredientQuantityRepository
{
    protected string $entityClassname = IngredientQuantity::class;
}
