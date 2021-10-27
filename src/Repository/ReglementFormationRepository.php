<?php

namespace App\Repository;

use App\Entity\ReglementFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReglementFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReglementFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReglementFormation[]    findAll()
 * @method ReglementFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReglementFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReglementFormation::class);
    }

    // /**
    //  * @return ReglementFormation[] Returns an array of ReglementFormation objects
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
    public function findOneBySomeField($value): ?ReglementFormation
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
