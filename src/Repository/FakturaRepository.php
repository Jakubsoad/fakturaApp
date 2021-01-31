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
}
