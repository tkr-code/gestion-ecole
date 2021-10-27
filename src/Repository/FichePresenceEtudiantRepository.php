<?php

namespace App\Repository;

use App\Entity\FichePresenceEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FichePresenceEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method FichePresenceEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method FichePresenceEtudiant[]    findAll()
 * @method FichePresenceEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FichePresenceEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FichePresenceEtudiant::class);
    }

    // /**
    //  * @return FichePresenceEtudiant[] Returns an array of FichePresenceEtudiant objects
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
    public function findOneBySomeField($value): ?FichePresenceEtudiant
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
