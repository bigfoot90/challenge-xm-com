<?php

namespace Application\CommandQuery;

abstract class AbstractCommand
{
    public static function fromArray(array $data): self
    {
        $command = new static();

        foreach ($data as $name => $value) {
            if ($value !== '' && \property_exists(static::class, $name)) {
                $command->$name = $value;
            }
        }

        return $command;
    }
}
