<?php

namespace Core\User\Infrastructure\Persistence\Doctrine;

use Core\Shared\Domain\ValueObject\Uuid;
use Core\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Core\User\Domain\Contract\UserRepository;
use Core\User\Domain\User;
use Core\User\Domain\Users;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct($registry, User::class);
    }

    public function save(User $user): void
    {
        $this->persist($user);
    }

    public function delete(User $user): void
    {
        $this->remove($user);
    }

    public function search(Uuid $uuid): ?User
    {
        return $this->repository()->findOneBy(['uuid' => $uuid]);
    }

    public function findPaginateBy(
        array $criteria = [],
        array $filters = [],
        array $orders = [],
        int $page = 1,
        ?int $size = null
    ): Users {
        $dql = $this->createQueryBuilder('o');


        // findBy
        foreach ($criteria as $k => $v) {
            if (property_exists(User::class, $k)) {
                $dql->andWhere("o.$k = :$k")->setParameter("$k", $v);
            }
        }


        // filters -> findByText
        if ($filters['text'] ?? false) {
            $dql->andWhere('o.name like :text')
                ->setParameter('text', '%' . $filters['text'] . '%');
        }


        // orderBy
        foreach ($orders as $k => $v) {
            if (property_exists(User::class, $k)) {
                $dql->addOrderBy('o.' . $k, $v);
            }
        }


        $paginator = new Paginator($dql->getQuery());

        if ($size) {
            $paginator->getQuery()
                ->setFirstResult($size * ($page - 1))
                ->setMaxResults($size);
        }

        return new Users(iterator_to_array($paginator->getIterator()));
    }
}
