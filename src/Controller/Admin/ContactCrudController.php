<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;


class ContactCrudController extends AbstractCustomCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return array_merge((array) parent::configureFields($pageName),[
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('email'),
            TelephoneField::new('phonenumber'),
            TextField::new('address'),
            ChoiceField::new('organisation')
        ]);
    }
}
