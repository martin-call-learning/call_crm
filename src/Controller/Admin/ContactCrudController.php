<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;


class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }


    public function configureFields(string $pageName): iterable
    {
        // Todo : put real fields.
        $translator = new Translator('fr_FR');
        return [
            IdField::new($translator->trans('contact.id')),
            TextField::new($translator->trans('contact.firstname')),
            TextField::new($translator->trans('contact.lastname')),
            TextField::new($translator->trans('contact.email')),
            TelephoneField::new($translator->trans('contact.phone')),
            TextField::new($translator->trans('contact.address')),
            ChoiceField::new($translator->trans('contact.organisation'))
        ];
    }
}
