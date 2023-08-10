<?php

namespace App\Controller\Admin;

use App\Entity\Grade;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
        return [
            ChoiceField::new('test', $translator->trans('grade.test')),
            ChoiceField::new('student', $translator->trans('grade.student')),
            IntegerField::new('score', $translator->trans('grade.score')),
        ];
    }
}
