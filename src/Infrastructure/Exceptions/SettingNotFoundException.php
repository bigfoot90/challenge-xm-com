<?php

namespace Infrastructure\Exceptions;

class SettingNotFoundException extends AppException
{
    public function __construct(string $key)
    {
        parent::__construct(sprintf('Setting "%s" does not exists', $key));
    }
}
