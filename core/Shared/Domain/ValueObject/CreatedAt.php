<?php

namespace Core\Shared\Domain\ValueObject;

use Core\Shared\Domain\ValueObject\Primitive\DateTimeValueObject;

final class CreatedAt extends DateTimeValueObject
{
    public function __construct(
        ?\DateTime $value = null
    ) {
        parent::__construct($value);
    }

    public static function now(): self
    {
        return new self(new \DateTime('now'));
    }
}
