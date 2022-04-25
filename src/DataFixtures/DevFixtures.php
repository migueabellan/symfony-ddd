<?php

namespace App\DataFixtures;

use App\DataFixtures\ObjectMother\UserMother;
use Core\User\Domain\Contract\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class DevFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public static function getGroups(): array
    {
        return ['app'];
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $user = UserMother::create();

            $this->userRepository->save($user);
        }
    }
}
