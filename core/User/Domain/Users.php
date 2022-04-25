<?php

namespace Core\User\Domain;

use Core\Shared\Domain\Collection;

final class Users extends Collection
{
    /*
    protected function type(): string
    {
        return User::class;
    }
    */

    public function toArray(): array
    {
        return array_map($this->userToArray(), $this->items);
    }

    private function userToArray(): callable
    {
        return static function (User $user) {
            return $user->toArray();
        };
    }
}
