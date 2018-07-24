<?php

namespace App\Repository;

use App\Entity\Simple;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Simple|null find($id, $lockMode = null, $lockVersion = null)
 * @method Simple|null findOneBy(array $criteria, array $orderBy = null)
 * @method Simple[]    findAll()
 * @method Simple[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SimpleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Simple::class);
    }

//    /**
//     * @return Simple[] Returns an array of Simple objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Simple
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
