<?php

namespace App\Repository;

use App\Entity\FormationAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * The FormationActionRepository class provides access to the FormationAction entity in the database.
 *
 * This repository handles database interactions for the FormationAction entity, including finding, saving, and removing
 * formation actions from the database. It also includes a method to retrieve formation actions grouped by formation.
 *
 * @method FormationAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormationAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormationAction[]    findAll()
 * @method FormationAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationActionRepository extends CrudEntityRepository
{

    /**
     * FormationActionRepository constructor.
     *
     * @param ManagerRegistry $registry The ManagerRegistry instance.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormationAction::class);
    }

    /**
     * Save a formation action entity to the database.
     *
     * @param FormationAction $entity The formation action entity to save.
     * @param bool $flush Whether to flush changes immediately (default: false).
     */
    public function save(FormationAction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Remove a formation action entity from the database.
     *
     * @param FormationAction $entity The formation action entity to remove.
     * @param bool $flush Whether to flush changes immediately (default: false).
     */
    public function remove(FormationAction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Find all formation actions grouped by formation.
     *
     * @return FormationAction[] An array of FormationAction objects grouped by formation.
     */
    public function findAllGroupedByFormation(): array {
        return $this->createQueryBuilder('fa')
            ->andWhere('fa.deletedAt IS NULL')
            ->groupBy('fa.formation')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return FormationAction[] Returns an array of FormationAction objects
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

//    public function findOneBySomeField($value): ?FormationAction
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
