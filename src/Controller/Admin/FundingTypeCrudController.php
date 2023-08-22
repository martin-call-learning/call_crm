<?php

namespace App\Controller\Admin;

use App\Entity\FundingType;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class FundingTypeCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return FundingType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');
        return array_merge([
            TextField::new('name', $translator->trans('funding_type.name')),
        ], (array) parent::configureFields($pageName));
    }
}
