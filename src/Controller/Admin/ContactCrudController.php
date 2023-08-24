<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Organisation;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

/**
 * CRUD controller for managing Contact entities.
 */
class ContactCrudController extends AbstractCrudEntityController
{
    /**
     * @inheritDoc
     */
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    /**
     * @inheritDoc
     */
    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');

        return array_merge([
            TextField::new('firstname', $translator->trans('contact.firstname')),
            TextField::new('lastname', $translator->trans('contact.lastname')),
            EmailField::new('email', $translator->trans('contact.email')),
            TelephoneField::new('phoneNumber', $translator->trans('contact.phone')),
            TextField::new('address', $translator->trans('contact.address')),
            AssociationField::new('organisation', $translator->trans('contact.organisation'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Organisation::class)
                    ->findNotDeleted()
            )->autocomplete()
        ], (array) parent::configureFields($pageName));
    }
}
