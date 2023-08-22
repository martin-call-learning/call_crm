<?php

namespace App\Controller\Admin;

use App\Entity\FormationAction;
use App\Entity\Organisation;
use App\Entity\Session;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
        $translator = new Translator('fr_FR');

        return array_merge([
            CollectionField::new("students", $translator->trans('session.students')),
            AssociationField::new('formationAction', $translator->trans('session.formation_action'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(FormationAction::class)
                    ->findNotDeleted()
            )->autocomplete(),
            DateField::new('startDate', $translator->trans('session.start_date')),
            DateField::new('endDate', $translator->trans('session.end_date')),
            // Todo : Has the funder to be in this CRUD Controller ??
        ], (array) parent::configureFields($pageName));
    }
}
