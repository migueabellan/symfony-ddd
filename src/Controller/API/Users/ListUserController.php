<?php

namespace App\Controller\API\Users;

use App\Controller\RestController;
use Core\User\Application\FindUsers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @Route("/api/users", methods={"GET"})
 */
final class ListUserController extends RestController
{
    protected function expectedParams(): array
    {
        return [
            'page' => intval($this->request->get('page', 1)),
            'size' => intval($this->request->get('size', null)),
            'text' => $this->request->get('text', null)
        ];
    }

    protected function expectedConstraints(): Collection
    {
        return new Constraints\Collection([
            'page' => [new Constraints\Type('integer'), new Constraints\Positive()],
            'size' => [new Constraints\Type('integer'), new Constraints\PositiveOrZero()],
            'text' => [new Constraints\Optional([new Constraints\Type('string')])]
        ]);
    }

    public function __invoke(FindUsers $findUsers): JsonResponse
    {
        $data = $this->expectedParams();
        $criteria = [
            // 'status' => PUBLISHED
        ];
        $filters = [
            'text' => $data['text']
        ];
        $orders = [
            'created_at' => 'ASC'
        ];
        $page = $data['page'];
        $size = $data['size'];


        $users = $findUsers->__invoke($criteria, $filters, $orders, $page, $size);


        $total = $users->count();
        $size = $size !== 0 ? $size : $total;
        $maxPages = $size !== 0 ? ceil($total / $size) : $total;
        $response = [
            'total' => $total,
            'page' => $page,
            'size' => $size,
            'maxPages' => $maxPages,
            'items' => []
        ];
        foreach ($users as $user) {
            $response['items'][] = $user->toArray();
        }

        return $this->json($response);
    }
}
