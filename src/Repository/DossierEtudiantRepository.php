<?php

namespace App\Repository;

use App\Entity\DossierEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DossierEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierEtudiant[]    findAll()
 * @method DossierEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierEtudiant::class);
    }

    // /**
    //  * @return DossierEtudiant[] Returns an array of DossierEtudiant objects
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
    public function findOneBySomeField($value): ?DossierEtudiant
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
