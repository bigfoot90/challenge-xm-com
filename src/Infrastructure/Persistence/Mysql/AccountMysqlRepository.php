<?php

namespace Infrastructure\Persistence\Mysql;

use Domain\Models\Entity\Account;
use Domain\Models\Entity\AccountRepository;

class AccountMysqlRepository extends AbstractMysqlRepository implements AccountRepository
{
    protected string $entityClassname = Account::class;
}
