<?php

namespace Core\User\Infrastructure\Persistence\Doctrine\Mapping;

use Core\Shared\Infrastructure\Persistence\Doctrine\Types\GenericStringType;
use Core\User\Domain\ValueObject\UserName;

final class UserNameType extends GenericStringType
{
    public static function customTypeName(): string
    {
        return 'user_name';
    }

    protected function typeClassName(): string
    {
        return UserName::class;
    }
}
