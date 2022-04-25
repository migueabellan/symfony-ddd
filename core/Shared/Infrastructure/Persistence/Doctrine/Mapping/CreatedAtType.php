<?php

namespace Core\Shared\Infrastructure\Persistence\Doctrine\Mapping;

use Core\Shared\Domain\ValueObject\CreatedAt;
use Core\Shared\Infrastructure\Persistence\Doctrine\Types\GenericDateTimeType;

final class CreatedAtType extends GenericDateTimeType
{
    public static function customTypeName(): string
    {
        return 'created_at';
    }

    protected function typeClassName(): string
    {
        return CreatedAt::class;
    }
}
