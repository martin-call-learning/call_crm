<?php

namespace App\Controller\Admin;

use App\Entity\FundingType;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FundingTypeCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return FundingType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return array_merge((array) parent::configureFields($pageName), [
            TextField::new('name'),
        ]);
    }
}
