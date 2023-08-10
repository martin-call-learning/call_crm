<?php

namespace App\Controller\Admin;

use App\Entity\Test;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
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

        return array_merge((array) parent::configureFields($pageName),[
            TextField::new('name', $translator->trans('test.name')),
            ChoiceField::new('skill', $translator->trans('test.skill')),
            ChoiceField::new('student', $translator->trans('test.student')),
            IntegerField::new('score', $translator->trans('test.score')),
        ]);
    }
}
