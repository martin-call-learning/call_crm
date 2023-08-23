<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use App\Entity\Grade;
use App\Entity\Student;
use App\Entity\Test;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Translation\Translator;

class GradeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Grade::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');
        return array_merge([
            AssociationField::new('test', $translator->trans('grade.test'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Test::class)
                    ->findNotDeleted()
            )->autocomplete(),
            AssociationField::new('student', $translator->trans('grade.student'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Student::class)
                    ->findNotDeleted()
            )->autocomplete(),
            IntegerField::new('score', $translator->trans('grade.score')),
        ], (array) parent::configureFields($pageName));
    }
}
