<?php

namespace Core\Shared\Domain\ValueObject;

use Core\Shared\Domain\ValueObject\Primitive\StringValueObject;
use Symfony\Component\Uid\Uuid as Uid;

final class Uuid extends StringValueObject
{
    public static function random(): self
    {
        return new self(Uid::v4()->toRfc4122());
    }
}
