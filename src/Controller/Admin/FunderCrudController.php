<?php

namespace App\Controller\Admin;

use App\Entity\Funder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints\Choice;

class FunderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Funder::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return [
            IdField::new($translator->trans('funder.id')),
            ChoiceField::new($translator->trans('funder.organisation')),
            TextField::new($translator->trans('funder.name')),
            ChoiceField::new($translator->trans('funder.type')),
        ];
    }
}
