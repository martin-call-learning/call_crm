<?php

namespace App\Controller\Admin;

use App\Entity\Grade;
use App\Entity\Skill;
use App\Entity\Test;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
            AssociationField::new('grades', $translator->trans('test.grades'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Grade::class)
                    ->findNotDeleted()
            )->autocomplete(),
        ], (array) parent::configureFields($pageName));
    }
}
