<?php

namespace Domain\Models\ValueObject;

use Symfony\Component\Uid\Uuid;

final class Id implements \JsonSerializable
{
    private Uuid $value;

    public function __construct(string $uuid = null)
    {
        $this->value = $uuid ? Uuid::fromString($uuid) : Uuid::v6();
    }

    public function value(): Uuid
    {
        return $this->value;
    }

    public function equals(self $otherId): bool
    {
        return $this->value->equals($otherId->value());
    }

    public function __toString(): string
    {
        return $this->value->toRfc4122();
    }

    public static function isValid(string $id): bool
    {
        return Uuid::isValid($id);
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}
