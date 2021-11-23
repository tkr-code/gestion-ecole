<?php

namespace App\Repository;

use App\Entity\DepartementChoix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DepartementChoix|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepartementChoix|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepartementChoix[]    findAll()
 * @method DepartementChoix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartementChoixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepartementChoix::class);
    }

    // /**
    //  * @return DepartementChoix[] Returns an array of DepartementChoix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DepartementChoix
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
