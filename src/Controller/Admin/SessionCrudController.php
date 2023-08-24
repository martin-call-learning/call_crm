<?php

namespace App\Controller\Admin;

use App\Entity\FormationAction;
use App\Entity\Session;
use App\Entity\Student;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use Symfony\Component\Translation\Translator;

class SessionCrudController extends AbstractCrudEntityController
{

    /**
     * @inheritDoc
     */
    public static function getEntityFqcn(): string
    {
        return Session::class;
    }

    /**
     * @inheritDoc
     */
    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return array_merge([
            AssociationField::new('students', $translator->trans('session.students'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Student::class)
                    ->findNotDeleted()
            )->autocomplete(),
            AssociationField::new('formationAction', $translator->trans('session.formation_action'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(FormationAction::class)
                    ->findNotDeleted()
            )->autocomplete(),
            DateField::new('startDate', $translator->trans('session.start_date')),
            DateField::new('endDate', $translator->trans('session.end_date')),
        ], (array) parent::configureFields($pageName));
    }
}
