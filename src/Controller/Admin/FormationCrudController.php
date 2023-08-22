<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class FormationCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return array_merge([
            TextField::new('name', $translator->trans('formation.name')),
            TextField::new('code', $translator->trans('formation.code')),
            TextEditorField::new('globalGoal', $translator->trans('formation.globalGoal')),
            TextEditorField::new('pedaGoal', $translator->trans('formation.pedaGoal')),
            TextEditorField::new('content', $translator->trans('formation.content')),
            TextEditorField::new('highlights', $translator->trans('formation.highlights')),
            TextEditorField::new('expectedResults', $translator->trans('formation.expectedResults'))
        ], (array) parent::configureFields($pageName));
    }
}
