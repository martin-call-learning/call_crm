<?php

namespace App\Repository;

use App\Entity\CrudEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends CrudEntityRepository<CrudEntityRepository>
 *
 * @method CrudEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrudEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrudEntity[]    findAll()
 * @method CrudEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
abstract class CrudEntityRepository extends ServiceEntityRepository {

    public function findNotDeleted(): array
    {
        return $this->createQueryBuilder('table')
            ->andWhere('table.deletedAt is null')
            ->getQuery()
            ->execute()
            ;
    }

}