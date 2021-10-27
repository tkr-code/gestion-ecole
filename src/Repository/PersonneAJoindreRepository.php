<?php

namespace App\Repository;

use App\Entity\PersonneAJoindre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonneAJoindre|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonneAJoindre|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonneAJoindre[]    findAll()
 * @method PersonneAJoindre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneAJoindreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonneAJoindre::class);
    }

    // /**
    //  * @return PersonneAJoindre[] Returns an array of PersonneAJoindre objects
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
    public function findOneBySomeField($value): ?PersonneAJoindre
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
