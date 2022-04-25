<?php

namespace App\Controller\API\Users;

use App\Controller\RestController;
use Core\User\Application\FindUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @Route("/api/users/{uuid}", methods={"GET"})
 */
final class FindUserController extends RestController
{
    protected function expectedParams(): array
    {
        return [
            'uuid' => $this->request->get('uuid')
        ];
    }

    protected function expectedConstraints(): Collection
    {
        return new Constraints\Collection([
            'uuid' => [new Constraints\NotBlank(), new Constraints\Uuid()]
        ]);
    }

    public function __invoke(FindUser $findUser, string $uuid): JsonResponse
    {
        $user = $findUser->__invoke($uuid);


        return $this->json($user->toArray());
    }
}
