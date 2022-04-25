<?php

namespace Core\Shared\Infrastructure\Persistence\Doctrine\Mapping;

use Core\Shared\Domain\ValueObject\Uuid;
use Core\Shared\Infrastructure\Persistence\Doctrine\Types\GenericStringType;

final class UuidType extends GenericStringType
{
    public static function customTypeName(): string
    {
        return 'uid';
    }

    protected function typeClassName(): string
    {
        return Uuid::class;
    }
}
