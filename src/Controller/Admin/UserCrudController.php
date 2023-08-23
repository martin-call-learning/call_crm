<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
        $translator = new Translator('fr_FR');

        return array_merge([
            TextField::new('username', $translator->trans('user.username')),
            TextField::new('password', $translator->trans('user.password'))->setFormType(PasswordType::class),
            AssociationField::new('roles', $translator->trans('user.roles'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Role::class)
                    ->findNotDeleted()
            )->autocomplete(),
            AssociationField::new('contact', $translator->trans('user.contact'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Contact::class)
                    ->findNotDeleted()
            )->autocomplete()
        ], (array) parent::configureFields($pageName));
    }
}
