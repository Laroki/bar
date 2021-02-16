<?php

namespace App\Repository;

use App\Entity\Beer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BeerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beer::class);
    }

    public function findLast()
    {
        return $this->createQueryBuilder('beer')
            ->orderBy('beer.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCategoryId(int $id): array
    {
        return $this->createQueryBuilder('beer')
            ->join('beer.categories', 'category')
            ->andWhere('category.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
