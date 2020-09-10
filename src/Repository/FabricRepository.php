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

    // /**
    //  * @return Fabric[] Returns an array of Fabric objects
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
    public function findOneBySomeField($value): ?Fabric
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
