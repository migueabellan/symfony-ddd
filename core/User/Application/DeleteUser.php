<?php

namespace Core\User\Application;

use Core\Shared\Domain\ValueObject\Uuid;
use Core\User\Domain\Contract\UserRepository;
use Core\User\Domain\User;

final class DeleteUser
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(
        string $uuid,
    ): ?User {
        $uuid = new Uuid($uuid);

        $user = $this->userRepository->search($uuid);

        // ToDo: if not exist?

        $this->userRepository->delete($user);

        // ToDo soft? hard?

        // $this->bus->publish(...$user->pullDomainEvents());

        return $user;
    }
}
