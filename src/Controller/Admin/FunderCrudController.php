<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Funder;
use App\Entity\FundingType;
use App\Entity\Organisation;
use App\Repository\OrganisationRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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

        return array_merge([
            TextField::new('name', $translator->trans('funder.name')),
            AssociationField::new('organisation', $translator->trans('funder.organisation'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Organisation::class)
                    ->findNotDeleted()
            )->autocomplete(),
            AssociationField::new('fundingType', $translator->trans('funder.type'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(FundingType::class)
                    ->findNotDeleted()
            )->autocomplete()
        ], (array) parent::configureFields($pageName));
    }
}
