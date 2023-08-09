<?php

namespace App\Controller\Admin;

use App\Entity\FundingType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FundingTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FundingType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
