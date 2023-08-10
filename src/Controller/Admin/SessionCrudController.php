<?php

namespace App\Controller\Admin;

use App\Entity\Session;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Translation\Translator;

class SessionCrudController extends AbstractCrudEntityController
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
            ArrayField::new("students", $translator->trans('session.students')),
            ChoiceField::new('formationAction', $translator->trans('session.formation_action')),
            DateField::new('startDate', $translator->trans('session.start_date')),
            DateField::new('endDate', $translator->trans('session.end_date')),
            // Todo : ChoiceField::new('funder') Has the funder to be in this CRUD Controller ??
        ]);
    }
}
