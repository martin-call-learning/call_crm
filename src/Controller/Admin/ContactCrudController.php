<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;


class ContactCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return array_merge((array) parent::configureFields($pageName),[
            TextField::new('firstname', $translator->trans('contact.firstname')),
            TextField::new('lastname', $translator->trans('contact.lastname')),
            TextField::new('email', $translator->trans('contact.email')),
            TelephoneField::new('phoneNumber', $translator->trans('contact.phone')),
            TextField::new('address', $translator->trans('contact.address')),
            ChoiceField::new('organisation', $translator->trans('contact.organisation'))
        ]);
    }
}
