<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use App\Entity\Test;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class TestCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return Test::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $translator =  new Translator('fr_FR');
        // Todo : Make choice field become Collection field
        return array_merge([
            TextField::new('name', $translator->trans('test.name')),
            AssociationField::new('skill', $translator->trans('test.skill'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Skill::class)
                    ->findNotDeleted()
            )->autocomplete(),
            CollectionField::new('grades', $translator->trans('test.grades'))
                ->setEntryIsComplex(true)
                ->useEntryCrudForm(GradeCrudController::class),
        ], (array) parent::configureFields($pageName));
    }
}
