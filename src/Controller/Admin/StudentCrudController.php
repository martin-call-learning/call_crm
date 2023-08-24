<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Organisation;
use App\Entity\Student;
use App\Repository\ContactRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Translation\Translator;

class StudentCrudController extends AbstractCrudEntityController
{

    /**
     * @inheritDoc
     */
    public static function getEntityFqcn(): string
    {
        return Student::class;
    }

    /**
     * @inheritDoc
     */
    public function configureFields(string $pageName): iterable
    {
        $translator = new Translator('fr_FR');


        return array_merge([
            AssociationField::new('contact', $translator->trans('student.contact'))->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Contact::class)
                    ->findNotDeleted()
            )->autocomplete()
        ], (array) parent::configureFields($pageName));
    }
}
