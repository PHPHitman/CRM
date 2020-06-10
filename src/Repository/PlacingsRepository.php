<?php

namespace App\Repository;

use App\Entity\Placings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Placings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Placings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Placings[]    findAll()
 * @method Placings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlacingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Placings::class);
    }

    // /**
    //  * @return Placings[] Returns an array of Placings objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Placings
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
