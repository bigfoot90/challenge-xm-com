<?php

namespace Infrastructure\Persistence\Mysql;

use Domain\Models\Entity\Chef;
use Domain\Models\Entity\ChefRepository;

class ChefMysqlRepository extends AbstractMysqlRepository implements ChefRepository
{
    protected string $entityClassname = Chef::class;
}
