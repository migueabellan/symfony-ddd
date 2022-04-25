<?php

namespace App\DataFixtures\ObjectMother;

use Core\User\Domain\User;
use Core\User\Domain\ValueObject\UserName;
use Faker\Factory;

final class UserMother
{
    public static function create(): User
    {
        $faker = Factory::create('es_ES');


        $name = new UserName($faker->firstName());

        $user = User::create($name);

        return $user;
    }
}
