<?php

namespace App\Repository;

use App\Entity\HasPostuled;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HasPostuled|null find($id, $lockMode = null, $lockVersion = null)
 * @method HasPostuled|null findOneBy(array $criteria, array $orderBy = null)
 * @method HasPostuled[]    findAll()
 * @method HasPostuled[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HasPostuledRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HasPostuled::class);
    }

    // /**
    //  * @return HasPostuled[] Returns an array of HasPostuled objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HasPostuled
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
