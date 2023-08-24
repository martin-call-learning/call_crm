<?php

namespace App\Repository;

use App\Entity\Funder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * The FunderRepository class provides access to the Funder entity in the database.
 *
 * This repository handles database interactions for the Funder entity, including finding, saving, and removing
 * funders from the database.
 *
 * @method Funder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Funder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Funder[]    findAll()
 * @method Funder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunderRepository extends CrudEntityRepository
{

    /**
     * FunderRepository constructor.
     *
     * @param ManagerRegistry $registry The ManagerRegistry instance.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Funder::class);
    }

    /**
     * Save a funder entity to the database.
     *
     * @param Funder $entity The funder entity to save.
     * @param bool $flush Whether to flush changes immediately (default: false).
     */
    public function save(Funder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Remove a funder entity from the database.
     *
     * @param Funder $entity The funder entity to remove.
     * @param bool $flush Whether to flush changes immediately (default: false).
     */
    public function remove(Funder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Funder[] Returns an array of Funder objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Funder
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
