<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Todo : put real fields.
        $translator = new Translator('fr_FR');

        return [
            IdField::new($translator->trans('formation.id')),
            TextField::new($translator->trans('formation.name')),
            TextField::new($translator->trans('formation.code')),
            TextEditorField::new($translator->trans('formation.globalGoal')),
            TextEditorField::new($translator->trans('formation.pedaGoal')),
            TextEditorField::new($translator->trans('formation.content')),
            TextEditorField::new($translator->trans('formation.highlights')),
            TextEditorField::new($translator->trans('formation.expectedResults'))
            ];
    }
}
