<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Translation\Translator;

class UserCrudController extends AbstractCrudEntityController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        // Todo : put real fields.
        $translator = new Translator('fr_FR');

        return array_merge((array) parent::configureFields($pageName), [
            TextField::new('username', $translator->trans('user.username')),
            TextField::new('password', $translator->trans('user.password'))->setFormType(PasswordType::class),
            AssociationField::new('roles', $translator->trans('user.role'))->autocomplete(),
            ChoiceField::new('contact', $translator->trans('user.contact'))->autocomplete()
        ]);
    }
}
