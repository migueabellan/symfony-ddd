<?php

namespace Core\User\Domain\Contract;

use Core\Shared\Domain\ValueObject\Uuid;
use Core\User\Domain\User;
use Core\User\Domain\Users;

interface UserRepository
{
    public function save(User $user): void;

    public function delete(User $user): void;

    public function search(Uuid $uuid): ?User;

    public function findPaginateBy(
        array $criteria = [],
        array $filters = [],
        array $orders = [],
        int $page = 1,
        ?int $size = null
    ): Users;
}
