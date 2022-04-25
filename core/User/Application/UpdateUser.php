<?php

namespace Core\User\Application;

use Core\Shared\Domain\ValueObject\Uuid;
use Core\User\Domain\Contract\UserRepository;
use Core\User\Domain\User;
use Core\User\Domain\ValueObject\UserName;

final class UpdateUser
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(
        string $uuid,
        ?string $name = null
    ): User {
        $uuid = new Uuid($uuid);

        $user = $this->userRepository->search($uuid);

        // ToDo: if not exist?


        $name = new UserName($name);

        $user->update($name);

        $this->userRepository->save($user);

        // $this->bus->publish(...$user->pullDomainEvents());

        return $user;
    }
}
