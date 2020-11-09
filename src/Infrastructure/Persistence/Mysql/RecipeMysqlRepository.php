<?php

namespace Infrastructure\Persistence\Mysql;

use Domain\Models\Entity\Recipe;
use Domain\Models\Entity\RecipeRepository;

class RecipeMysqlRepository extends AbstractMysqlRepository implements RecipeRepository
{
    protected string $entityClassname = Recipe::class;
}
