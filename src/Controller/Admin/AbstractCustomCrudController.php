<?php

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

abstract class AbstractPersistEntityCrudController extends AbstractCrudController {

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void {
        $entityInstance
    }

}