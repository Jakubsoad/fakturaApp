<?php

namespace App\Repository;

use App\Entity\Faktura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Faktura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Faktura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Faktura[]    findAll()
 * @method Faktura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FakturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Faktura::class);
    }

    // /**
    //  * @return Faktura[] Returns an array of Faktura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Faktura
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
