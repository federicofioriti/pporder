<?php

namespace App\Repository;

use App\Entity\OrderHead;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderHead|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderHead|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderHead[]    findAll()
 * @method OrderHead[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderHeadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderHead::class);
    }

    // /**
    //  * @return OrderHead[] Returns an array of OrderHead objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderHead
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
