<?php

namespace App\Repository;

use App\Entity\DefisSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DefisSante|null find($id, $lockMode = null, $lockVersion = null)
 * @method DefisSante|null findOneBy(array $criteria, array $orderBy = null)
 * @method DefisSante[]    findAll()
 * @method DefisSante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefisSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DefisSante::class);
    }

    // /**
    //  * @return DefisSante[] Returns an array of DefisSante objects
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
    public function findOneBySomeField($value): ?DefisSante
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
