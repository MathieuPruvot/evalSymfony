<?php

namespace App\Repository;

use App\Entity\BlogSpot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BlogSpot|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogSpot|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogSpot[]    findAll()
 * @method BlogSpot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogSpotRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BlogSpot::class);
    }

    // /**
    //  * @return BlogSpot[] Returns an array of BlogSpot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogSpot
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
