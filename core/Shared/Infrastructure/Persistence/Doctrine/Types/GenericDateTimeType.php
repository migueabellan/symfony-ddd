<?php

namespace Core\Shared\Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType;

abstract class GenericDateTimeType extends DateTimeType implements DoctrineCustomType
{
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }

        $value = parent::convertToPHPValue($value, $platform);
        $className = $this->typeClassName();

        return new $className($value);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }

        return parent::convertToDatabaseValue($value->value(), $platform);
    }

    abstract protected function typeClassName(): string;
}
