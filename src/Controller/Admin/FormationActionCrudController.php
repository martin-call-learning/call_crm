<?php

namespace App\Controller\Admin;

use App\Entity\FormationAction;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class FormationActionCrudController extends AbstractCustomCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormationAction::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return array_merge((array) parent::configureFields($pageName),[
            DateTimeField::new('duration'),
            IntegerField::new('expected_student_count'),
            MoneyField::new('price')->setCurrency('EUR'),
            BooleanField::new('remote'),
            BooleanField::new('presential'),
            IntegerField::new('level_required')
        ]);
    }
}
