<?php

namespace Domain\Models\Entity;

use Domain\SettingsPool;

class Setting
{
    private string $name;
    private string $value;
    private string $type;

    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;

    public function __construct(string $name, $value, string $type = null)
    {
        $this->setName($name);
        $this->setType($type ?? $this->guessType($value));
        $this->setValue($value);
        $this->createdAt = $this->updatedAt = new \DateTimeImmutable();
    }

    public static function isNameValid(string $name): bool
    {
        return in_array($name, SettingsPool::getAllNames(), true);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * This method should be private as it should be called once by the contructor only.
     */
    private function setName(string $name)
    {
        if (!self::isNameValid($name)) {
            throw new \Exception(sprintf('Invalid setting name "%s"', $name));
        }

        $this->name = $name;
    }

    /**
     * Get parsed type.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set parsed type.
     */
    public function setType(string $type)
    {
        $allowed = [
            'date',
            'datetime',
            'boolean',
            'integer',
            'float',
            'string',
        ];

        if (!in_array($type, $allowed)) {
            throw new \Exception(sprintf('Invalid type "%2$s" for setting "%1$s"', $this->name, $type));
        }

        $this->type = $type;
    }

    /**
     * Guess type by value.
     */
    public function guessType($value)
    {
        if ($value instanceof \DateTimeInterface) {
            return 'datetime';
        }

        return \gettype($value);
    }

    /**
     * Get parsed value.
     */
    public function getValue()
    {
        switch ($this->type) {
            case 'boolean':
                return (bool) $this->value;

            case 'integer':
                return (int) $this->value;

            case 'float':
                return (float) $this->value;

            case 'string':
                return (string) $this->value;

            case 'date':
                return Carbon::parse($this->value)->setTime(0, 0, 0, 0);

            case 'datetime':
                return Carbon::parse($this->value);
        }

        throw new \Exception(sprintf('Invalid type "%2$s" in setting "%1$s"', $this->name, $this->type));
    }

    /**
     * Set parsed value.
     */
    public function setValue($value)
    {
        switch ($this->type) {
            case 'boolean':
                $this->value = (string) (int) $value;

                return;

            case 'date':
                if (!$value instanceof \DateTimeInterface) {
                    throw new \Exception(sprintf('The value should be an instance of DateTimeInterface'));
                }

                $this->value = $value->format('Y-m-d');

                return;

            case 'datetime':
                if (!$value instanceof \DateTimeInterface) {
                    throw new \Exception(sprintf('The value should be an instance of DateTimeInterface'));
                }

                $this->value = $value->format('Y-m-d h:i:s');

                return;

            case 'integer':
            case 'float':
            case 'string':
                $this->value = (string) $value;

                return;
        }

        throw new \Exception(sprintf('Invalid type "%2$s" for setting "%1$s"', $this->name, $this->type));
    }

    public function __toString()
    {
        return $this->value;
    }
}
