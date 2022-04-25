<?php

namespace Core\Shared\Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

abstract class GenericStringType extends StringType implements DoctrineCustomType
{
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        $className = $this->typeClassName();
        if ($value === null) {
            return null;
        }

        return new $className($value);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }

        return $value->value();
    }

    abstract protected function typeClassName(): string;
}
