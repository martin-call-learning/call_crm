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
        $translator = new Translator('fr_FR');

        yield IdField::new($translator->trans('formation_action.id'));
        yield DateTimeField::new($translator->trans('formation_action.duration'));
        yield IntegerField::new($translator->trans('formation_action.expected_student_count'));
        yield MoneyField::new($translator->trans('formation_action.price'))->setCurrency('EUR');
        yield BooleanField::new($translator->trans('formation_action.remote'));
        yield BooleanField::new($translator->trans('formation_action.presential'));
        yield IntegerField::new($translator->trans('formation_action.level_required'));
    }
}
