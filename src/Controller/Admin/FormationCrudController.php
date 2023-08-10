<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class FormationCrudController extends AbstractCustomCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Todo : put real fields.
        $translator = new Translator('fr_FR');

        return array_merge((array) parent::configureFields($pageName), [
            TextField::new('name'),
            TextField::new('code'),
            TextEditorField::new('globalGoal'),
            TextEditorField::new('pedaGoal'),
            TextEditorField::new('content'),
            TextEditorField::new('highlights'),
            TextEditorField::new('expectedResults')
            ]);
    }
}
