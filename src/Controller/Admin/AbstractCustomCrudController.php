<?php

namespace App\Controller\Admin;

use App\Entity\CrudEntity;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

/**
 * This implementation of AbstractCrudController automates the create, updated and deleted at attributes for every entity.
 */
abstract class AbstractCustomCrudController extends AbstractCrudController {

    /**
     * This methods sets the createdAt attribute for a CrudEntity when creating it.
     *
     * @param EntityManagerInterface $entityManager
     * @param $entityInstance
     * @return void
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void {
        if($entityInstance instanceof CrudEntity){
            $entityInstance->setCreatedAt(new DateTimeImmutable());

            parent::persistEntity($entityManager, $entityInstance);
        }
    }

    /**
     * This methods sets the updtaedAt attribute for a CrudEntity when updating it.
     *
     * @param EntityManagerInterface $entityManager
     * @param $entityInstance
     * @return void
     */
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void {
        if($entityInstance instanceof CrudEntity){
            $entityInstance->setUpdatedAt(new DateTimeImmutable());

            parent::updateEntity($entityManager, $entityInstance);
        }
    }

    /**
     * This methods sets the deletedAt attribute for a CrudEntity when deleting it.
     *
     * @param EntityManagerInterface $entityManager
     * @param $entityInstance
     * @return void
     */
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void {
        if($entityInstance instanceof CrudEntity){
            $entityInstance->setDeletedAt(new DateTimeImmutable());

            parent::updateEntity($entityManager, $entityInstance); // Todo: see if we can use the parent::deleteEntity method instead.
        }
    }

}