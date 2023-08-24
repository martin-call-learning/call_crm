<?php

namespace App\Controller\Admin;

use App\Entity\Organisation;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class OrganisationCrudController extends AbstractCrudEntityController
{

    /**
     * @inheritDoc
     */
    public static function getEntityFqcn(): string
    {
        return Organisation::class;
    }

    /**
     * @inheritDoc
     */
    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return array_merge([
            TextField::new('name', $translator->trans('organisation.name')),
        ], (array) parent::configureFields($pageName));
    }
}
