<?php

declare(strict_types=1);

namespace Core\Shared\Domain\ValueObject\Primitive;

abstract class DateTimeValueObject
{
    public const FORMAT_DATE = 'Y-m-d';
    public const FORMAT_DATETIME = 'Y-m-d H:i:s';

    public function __construct(
        private ?\DateTime $value = null
    ) {
    }

    public function value(): ?\DateTime
    {
        return $this->value;
    }

    public function toDate(): ?string
    {
        return $this->value?->format(self::FORMAT_DATE);
    }

    public function toDateTime(): ?string
    {
        return $this->value?->format(self::FORMAT_DATETIME);
    }

    /*
    public static function now(): static
    {
        return new static(new \DateTime('now'));
    }
    */

    /*
    public function isBefore(\DateTime $date): bool
    {
        return $this->value < $date;
    }

    public function isAfter(\DateTime $date): bool
    {
        return $this->value > $date;
    }

    // ToDo: diff ...
    */

    public function __toString(): string
    {
        return $this->toDateTime();
    }
}
