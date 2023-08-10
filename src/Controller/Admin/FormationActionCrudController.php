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
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
            DateTimeField::new('deletedAt')->hideOnForm(),

            DateTimeField::new('duration'),
            IntegerField::new('expected_student_count'),
            MoneyField::new('price')->setCurrency('EUR'),
            BooleanField::new('remote'),
            BooleanField::new('presential'),
            IntegerField::new('level_required')
        ];
    }
}
