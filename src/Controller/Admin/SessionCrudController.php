<?php

namespace App\Controller\Admin;

use App\Entity\Session;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Translation\Translator;

class SessionCrudController extends AbstractCustomCrudController
{
    public static function getEntityFqcn(): string
    {
        return Session::class;
    }


    public function configureFields(string $pageName): iterable
    {
        // Todo : put real fields.
        $translator = new Translator('fr_FR');

        return array_merge((array) parent::configureFields($pageName), [
            ArrayField::new("students"),
            ChoiceField::new('formationAction'),
            DateField::new('startDate'),
            DateField::new('endDate'),
            // Todo : ChoiceField::new('funder') Has the funder to be in this CRUD Controller ??
        ]);
    }
}
