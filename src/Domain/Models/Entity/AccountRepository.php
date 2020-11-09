<?php

namespace Domain\Models\Entity;

interface AccountRepository
{
    /**
     * @return ?Account
     */
    public function get($criteria);

    /**
     * @return Account[]
     */
    public function list(array $criteria = [], array $sorting = null);

    public function save(Account $account): void;
}
