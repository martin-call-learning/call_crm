<?php

namespace App\Controller\Admin;

use App\Entity\Funder;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class FunderCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return Funder::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return array_merge((array) parent::configureFields($pageName),[
            TextField::new('name', $translator->trans('funder.name')),
            ChoiceField::new('organisation', $translator->trans('funder.organisation')),
            ChoiceField::new('fundingType', $translator->trans('funder.type')),
        ]);
    }
}
