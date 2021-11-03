<?php

namespace App\Repository;

use App\Entity\CoefficientMatiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoefficientMatiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoefficientMatiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoefficientMatiere[]    findAll()
 * @method CoefficientMatiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoefficientMatiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoefficientMatiere::class);
    }

    // /**
    //  * @return CoefficientMatiere[] Returns an array of CoefficientMatiere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoefficientMatiere
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
