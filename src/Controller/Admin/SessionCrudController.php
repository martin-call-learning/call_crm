<?php

namespace App\Controller\Admin;

use App\Entity\Session;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Translation\Translator;

class SessionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Session::class;
    }


    public function configureFields(string $pageName): iterable
    {
        // Todo : put real fields.
        $translator = new Translator('fr_FR');

        return [
            IdField::new($translator->trans('session.id')),
            ChoiceField::new($translator->trans("session.student")),
            ChoiceField::new($translator->trans('session.formation_action')),
            DateField::new($translator->trans('session.start_date')),
            DateField::new($translator->trans('session.end_date')),
            ChoiceField::new($translator->trans('session.funder'))
        ];
    }
}
