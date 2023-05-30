<?php

namespace App\Controller\Admin;

use App\Entity\Organisation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class OrganisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Organisation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return [
            IdField::new($translator->trans('organisation.id')),
            TextField::new($translator->trans('organisation.name')),
        ];
    }
}
