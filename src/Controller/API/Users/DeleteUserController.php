<?php

namespace App\Controller\API\Users;

use App\Controller\RestController;
use Core\User\Application\DeleteUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @Route("/api/users/{uuid}", methods={"DELETE"})
 */
final class DeleteUserController extends RestController
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

    public function __invoke(DeleteUser $deleteUser, string $uuid): JsonResponse
    {
        $user = $deleteUser->__invoke($uuid);

        return $this->json([]);

        // ToDo: soft
        // return $this->json($user->toArray());
    }
}
