<?php

namespace Core\Shared\Infrastructure\Persistence\Doctrine;

use Core\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

abstract class DoctrineRepository
{
    protected EntityManagerInterface $em;
    protected ClassMetadata $class;

    /**
     * @param class-string<object> $entityClass
     */
    public function __construct(
        ManagerRegistry $registry,
        string $entityClass
    ) {
        $manager = $registry->getManagerForClass($entityClass);

        if ($manager === null) {
            throw new \LogicException(sprintf('Could not find the entity manager for class "%s".', $entityClass));
        }

        $this->em = $manager;
        $this->class = $manager->getClassMetadata($entityClass);
    }

    public function createQueryBuilder(mixed $alias, mixed $indexBy = null): QueryBuilder
    {
        return $this->em->createQueryBuilder()
            ->select($alias)
            ->from($this->class->name, $alias, $indexBy);
    }

    public function repository(): EntityRepository
    {
        return $this->em->getRepository($this->class->name);
    }

    public function persist(AggregateRoot $entity): void
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function remove(AggregateRoot $entity): void
    {
        $this->em->remove($entity);
        $this->em->flush();
    }
}
