<?php

namespace App\Repository;

use App\Entity\FundingType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * The FundingTypeRepository class provides access to the FundingType entity in the database.
 *
 * This repository handles database interactions for the FundingType entity, including finding, saving, and removing
 * funding types from the database.
 *
 * @method FundingType|null find($id, $lockMode = null, $lockVersion = null)
 * @method FundingType|null findOneBy(array $criteria, array $orderBy = null)
 * @method FundingType[]    findAll()
 * @method FundingType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FundingTypeRepository extends CrudEntityRepository
{

    /**
     * FundingTypeRepository constructor.
     *
     * @param ManagerRegistry $registry The ManagerRegistry instance.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FundingType::class);
    }

    /**
     * Save a funding type entity to the database.
     *
     * @param FundingType $entity The funding type entity to save.
     * @param bool $flush Whether to flush changes immediately (default: false).
     */
    public function save(FundingType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Remove a funding type entity from the database.
     *
     * @param FundingType $entity The funding type entity to remove.
     * @param bool $flush Whether to flush changes immediately (default: false).
     */
    public function remove(FundingType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FunderType[] Returns an array of FunderType objects
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

//    public function findOneBySomeField($value): ?FunderType
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
