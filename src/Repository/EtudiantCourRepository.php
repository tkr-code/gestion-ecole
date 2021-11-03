<?php

namespace App\Repository;

use App\Entity\EtudiantCour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtudiantCour|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudiantCour|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudiantCour[]    findAll()
 * @method EtudiantCour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantCourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudiantCour::class);
    }

    // /**
    //  * @return EtudiantCour[] Returns an array of EtudiantCour objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtudiantCour
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
