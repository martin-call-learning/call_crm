<?php

namespace App\Controller\Admin;

use App\Entity\Organisation;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class OrganisationCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return Organisation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return array_merge([
            TextField::new('name', $translator->trans('organisation.name')),
        ], (array) parent::configureFields($pageName));
    }
}
