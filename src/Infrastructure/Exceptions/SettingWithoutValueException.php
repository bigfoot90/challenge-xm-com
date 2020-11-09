<?php

namespace Infrastructure\Exceptions;

class SettingWithoutValueException extends AppException
{
    public function __construct(string $key)
    {
        parent::__construct(sprintf('Setting "%s" does not have a default values', $key));
    }
}
