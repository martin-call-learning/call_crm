<?php

namespace App\Controller\Admin;

use App\Entity\CrudEntity;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

/**
 * This implementation of AbstractCrudController automates the create, updated and deleted at attributes for every entity.
 */
abstract class AbstractCrudEntityController extends AbstractCrudController {

    /**
     * This methods sets the createdAt attribute for a CrudEntity when creating it.
     *
     * @param EntityManagerInterface $entityManager
     * @param $entityInstance
     * @return void
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void {
        if(in_array(CrudEntity::class, class_uses($entityInstance::class), true)){
            $entityInstance->setCreatedAt(new DateTimeImmutable);
            parent::persistEntity($entityManager, $entityInstance);
        }
    }

    /**
     * This methods sets the updatedAt attribute for a CrudEntity when updating it.
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

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
            DateTimeField::new('deletedAt')->hideOnForm(),
        ];
    }

}