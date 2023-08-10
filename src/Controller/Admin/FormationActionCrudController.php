<?php

namespace App\Controller\Admin;

use App\Entity\FormationAction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Translation\Translator;

class FormationActionCrudController extends AbstractCrudController
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
