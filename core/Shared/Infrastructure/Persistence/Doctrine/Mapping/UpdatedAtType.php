<?php

namespace Core\Shared\Infrastructure\Persistence\Doctrine\Mapping;

use Core\Shared\Domain\ValueObject\UpdatedAt;
use Core\Shared\Infrastructure\Persistence\Doctrine\Types\GenericDateTimeType;

final class UpdatedAtType extends GenericDateTimeType
{
    public static function customTypeName(): string
    {
        return 'updated_at';
    }

    protected function typeClassName(): string
    {
        return UpdatedAt::class;
    }
}
