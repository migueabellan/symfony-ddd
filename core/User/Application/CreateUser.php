<?php

namespace Core\User\Application;

use Core\User\Domain\Contract\UserRepository;
use Core\User\Domain\User;
use Core\User\Domain\ValueObject\UserName;

final class CreateUser
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(
        string $name
    ): User {
        $name = new UserName($name);

        $user = User::create($name);

        $this->userRepository->save($user);

        // $this->bus->publish(...$user->pullDomainEvents());

        return $user;
    }
}
