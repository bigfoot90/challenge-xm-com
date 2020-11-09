<?php

namespace Domain\Models\Entity;

interface SettingRepository
{
    /**
     * @return ?Setting
     */
    public function get($criteria);

    /**
     * @return Setting[]
     */
    public function list(array $criteria = [], array $sorting = null);

    public function save(Setting $setting): void;
}
