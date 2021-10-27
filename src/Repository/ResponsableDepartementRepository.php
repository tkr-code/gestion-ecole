<?php

namespace App\Repository;

use App\Entity\ResponsableDepartement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResponsableDepartement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponsableDepartement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponsableDepartement[]    findAll()
 * @method ResponsableDepartement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsableDepartementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsableDepartement::class);
    }

    // /**
    //  * @return ResponsableDepartement[] Returns an array of ResponsableDepartement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResponsableDepartement
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
