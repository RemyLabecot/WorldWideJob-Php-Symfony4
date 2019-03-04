<?php

namespace App\Repository;

use App\Entity\IsFavorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IsFavorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method IsFavorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method IsFavorite[]    findAll()
 * @method IsFavorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IsFavoriteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IsFavorite::class);
    }

    // /**
    //  * @return IsFavorite[] Returns an array of IsFavorite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IsFavorite
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
