<?php

namespace Core\Shared\Domain\ValueObject\Primitive;

abstract class StringValueObject
{
    public function __construct(
        private string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }

    /*
    public function isEquals(self $other): bool
    {
        return $this->value() === $other->value();
    }
    */

    public function __toString(): string
    {
        return $this->value;
    }
}
