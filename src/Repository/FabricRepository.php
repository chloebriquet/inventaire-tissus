<?php

namespace App\Repository;

use App\Entity\Fabric;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Fabric find($id, $lockMode = null, $lockVersion = null)
 * @method null|Fabric findOneBy(array $criteria, array $orderBy = null)
 * @method Fabric[]    findAll()
 * @method Fabric[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FabricRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fabric::class);
    }
}
