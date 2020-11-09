<?php

namespace Infrastructure\Events;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationErrorEvent
{
    private array $violations;

    public function __construct(ConstraintViolationListInterface $list)
    {
        $this->violations = self::violationListToArray($list);
    }

    public function getViolations(): array
    {
        return $this->violations;
    }

    private static function violationListToArray(ConstraintViolationListInterface $violations): array
    {
        /** @var ConstraintViolationInterface $violation */
        foreach ($violations as $violation) {
            $result[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return $result ?? [];
    }
}
