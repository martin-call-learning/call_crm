<?php

namespace App\Admin\Fields;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;

class MultipleAssociationField implements FieldInterface {

    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null) {

        // Todo : create new Type in order to have multiple objects.

        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)

            // this template is used in 'index' and 'detail' pages
            ->setTemplatePath('admin/field/dateInterval/list.html.twig')

            // this is used in 'edit' and 'new' pages to edit the field contents
            // you can use your own form types too
            ->setFormType(EntityType::class)
            ->addCssClass('field-dateInterval')

            // these methods allow to define the web assets loaded when the
            // field is displayed in any CRUD page (index/detail/edit/new)
            //->addCssFiles('public/css/field-dateInterval.css')
            //->addJsFiles('js/admin/field-dateInterval.js')
        ;
    }

    public function getAsDto(): FieldDto {
        return $this->dto;
    }
}