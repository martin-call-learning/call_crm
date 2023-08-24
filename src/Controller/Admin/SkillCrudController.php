<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Translation\Translator;

class SkillCrudController extends AbstractCrudEntityController
{

    /**
     * @inheritDoc
     */
    public static function getEntityFqcn(): string
    {
        return Skill::class;
    }

    /**
     * @inheritDoc
     */
    public function configureFields(string $pageName): iterable
    {
        $translator =  new Translator('fr_FR');
        return array_merge([
            TextField::new('name', $translator->trans('skill.name'))
        ], (array) parent::configureFields($pageName));
    }
}
