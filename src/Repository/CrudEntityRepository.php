<?php

namespace App\Repository;

use App\Entity\CrudEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * The CrudEntityRepository class provides a base repository for entities with CRUD operations.
 *
 * This repository class extends ServiceEntityRepository and adds a method to retrieve entities that are not marked as deleted.
 *
 * @method CrudEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrudEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrudEntity[]    findAll()
 * @method CrudEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

abstract class CrudEntityRepository extends ServiceEntityRepository {

    /**
     * Find entities that are not marked as deleted.
     *
     * @return CrudEntity[] An array of entities that are not deleted.
     */
    public function findNotDeleted(): array
    {
        return $this->createQueryBuilder('table')
            ->andWhere('table.deletedAt IS NULL')
            ->getQuery()
            ->execute()
            ;
    }

}