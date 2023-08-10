<?php

namespace App\Controller\Admin;

use App\Entity\Organisation;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class OrganisationCrudController extends AbstractCustomCrudController
{
    public static function getEntityFqcn(): string
    {
        return Organisation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return array_merge((array) parent::configureFields($pageName), [
            TextField::new('name'),
        ]);
    }
}
