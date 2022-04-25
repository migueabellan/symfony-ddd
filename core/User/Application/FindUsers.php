<?php

namespace Core\User\Application;

use Core\User\Domain\Contract\UserRepository;
use Core\User\Domain\Users;

final class FindUsers
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(
        array $criteria = [],
        array $filters = [],
        array $orders = [],
        int $page = 1,
        ?int $size = null
    ): Users {
        return $this->userRepository->findPaginateBy(
            $criteria,
            $filters,
            $orders,
            $page,
            $size
        );
    }
}
