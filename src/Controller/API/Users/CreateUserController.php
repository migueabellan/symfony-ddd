<?php

namespace App\Controller\API\Users;

use App\Controller\RestController;
use Core\User\Application\CreateUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @Route("/api/users", methods={"POST"})
 */
final class CreateUserController extends RestController
{
    protected function expectedParams(): array
    {
        return $this->getRequestBody();
    }

    protected function expectedConstraints(): Collection
    {
        return new Constraints\Collection([
            'name' => [new Constraints\NotBlank(), new Constraints\Type('string')]
        ]);
    }

    public function __invoke(CreateUser $createUser): JsonResponse
    {
        $data = $this->expectedParams();
        $name = $data['name'];


        $user = $createUser->__invoke($name);


        return $this->json($user->toArray());
    }
}
