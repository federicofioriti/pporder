<?php

namespace App\Repository;

use App\Entity\OrderBody;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderBody|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderBody|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderBody[]    findAll()
 * @method OrderBody[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderBodyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderBody::class);
    }

    // /**
    //  * @return OrderBody[] Returns an array of OrderBody objects
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
    public function findOneBySomeField($value): ?OrderBody
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
