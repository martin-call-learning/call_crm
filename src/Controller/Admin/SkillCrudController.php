<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SkillCrudController extends AbstractCustomCrudController
{
    public static function getEntityFqcn(): string
    {
        return Skill::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return array_merge((array) parent::configureFields($pageName), [
            TextField::new('name')
        ]);
    }
}
