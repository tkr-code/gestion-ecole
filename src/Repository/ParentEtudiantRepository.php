<?php

namespace App\Repository;

use App\Entity\ParentEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParentEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParentEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParentEtudiant[]    findAll()
 * @method ParentEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParentEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParentEtudiant::class);
    }

    // /**
    //  * @return ParentEtudiant[] Returns an array of ParentEtudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParentEtudiant
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
