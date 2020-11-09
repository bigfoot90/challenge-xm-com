<?php

namespace Infrastructure\Persistence\Mysql;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;
use Domain\Models\ValueObject\Id;

abstract class AbstractMysqlRepository
{
    protected EntityManagerInterface $manager;

    protected string $entityClassname;
    protected array $defaultSorting = [];

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    protected function getBuilder(string $alias): QueryBuilder
    {
        return $this->manager
            ->createQueryBuilder()
            ->from($this->entityClassname, $alias)
            ->select($alias);
    }

    public function repo(): ObjectRepository
    {
        return $this->manager->getRepository($this->entityClassname);
    }

    public function count(array $criteria = []): int
    {
        return $this->repo()->count($criteria);
    }

    public function get($criteria)
    {
        if (is_string($criteria)) {
            return $this->repo()->find(new Id($criteria));
        }

        if ($criteria instanceof Id) {
            return $this->repo()->find($criteria);
        }

        return $this->repo()->findOneBy($criteria);
    }

    public function list(array $criteria = [], array $sorting = null, int $page = 1)
    {
        return $this->repo()->findBy($criteria, $sorting ?? $this->defaultSorting);
    }

    public function listMatching(Criteria $criteria)
    {
        if ($this->defaultSorting && empty($criteria->getOrderings())) {
            $criteria->orderBy($this->defaultSorting);
        }

        return $this->repo()->matching($criteria);
    }

    public function save(object $entity): void
    {
        $this->manager->persist($entity);
        $this->manager->flush();
    }

    public function delete(object $entity): void
    {
        $this->manager->remove($entity);
        $this->manager->flush();
    }

    public function transactional(callable $callback): void
    {
        $this->manager->beginTransaction();

        $callback();

        $this->manager->flush();
        $this->manager->commit();
    }
}
