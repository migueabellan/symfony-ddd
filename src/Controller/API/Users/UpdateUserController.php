<?php

namespace App\Controller\API\Users;

use App\Controller\RestController;
use Core\User\Application\UpdateUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @Route("/api/users/{uuid}", methods={"PATCH"})
 */
final class UpdateUserController extends RestController
{
    protected function expectedParams(): array
    {
        return array_merge(
            ['uuid' => $this->request->get('uuid')],
            $this->getRequestBody()
        );
    }

    protected function expectedConstraints(): Collection
    {
        return new Constraints\Collection([
            'uuid' => [new Constraints\NotBlank(), new Constraints\Uuid()],
            'name' => [new Constraints\Optional([new Constraints\Type('string')])]
        ]);
    }

    public function __invoke(UpdateUser $updateUser, string $uuid): JsonResponse
    {
        $data = $this->expectedParams();
        $name = $data['name'];

        $user = $updateUser->__invoke($uuid, $name);


        return $this->json($user->toArray());
    }
}
