<?php

namespace Infrastructure\Persistence\Mysql;

use Domain\Models\Entity\Setting;
use Domain\Models\Entity\SettingRepository;

class SettingMysqlRepository extends AbstractMysqlRepository implements SettingRepository
{
    protected string $entityClassname = Setting::class;
}
