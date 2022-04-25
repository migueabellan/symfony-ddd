<?php

namespace Core\Shared\Infrastructure\Persistence\Doctrine\Types;

interface DoctrineCustomType
{
    public static function customTypeName(): string;
}
