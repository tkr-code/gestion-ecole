<?php

namespace App\Repository;

use App\Entity\MatiereDansFiliere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatiereDansFiliere|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatiereDansFiliere|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatiereDansFiliere[]    findAll()
 * @method MatiereDansFiliere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatiereDansFiliereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatiereDansFiliere::class);
    }

    // /**
    //  * @return MatiereDansFiliere[] Returns an array of MatiereDansFiliere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MatiereDansFiliere
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
