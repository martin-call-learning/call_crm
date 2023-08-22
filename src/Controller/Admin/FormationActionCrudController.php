<?php

namespace App\Controller\Admin;

use App\Admin\Fields\DateIntervalField;
use App\Entity\Formation;
use App\Entity\FormationAction;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Symfony\Component\Translation\Translator;

class FormationActionCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return FormationAction::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');
        return array_merge((array) parent::configureFields($pageName),[
            AssociationField::new('formation', $translator->trans('formation_action.formation'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Formation::class)
                    ->findNotDeleted()
            )->autocomplete(),
            DateIntervalField::new('duration', $translator->trans('formation_action.duration')),
            IntegerField::new('expected_student_count', $translator->trans('formation_action.expected_student_count')),
            MoneyField::new('price', $translator->trans('formation_action.price'))->setCurrency('EUR'),
            BooleanField::new('remote', $translator->trans('formation_action.remote')),
            BooleanField::new('presential', $translator->trans('formation_action.presential')),
            IntegerField::new('level_required', $translator->trans('formation_action.level_required'))
        ]);
    }
}
