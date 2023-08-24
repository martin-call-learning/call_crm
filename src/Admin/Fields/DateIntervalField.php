<?php

namespace App\Admin\Fields;

use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

/**
 * A custom field type for displaying and editing DateInterval values.
 */
class DateIntervalField implements FieldInterface {

    use FieldTrait;

    /**
     * Create a new instance of the DateIntervalField.
     *
     * @param string $propertyName The name of the property the field is associated with.
     * @param string|null $label The label to be displayed for the field.
     * @return self A new instance of the DateIntervalField.
     */
    public static function new(string $propertyName, ?string $label = null) {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)

            // this template is used in 'index' and 'detail' pages
            ->setTemplatePath('admin/field/dateInterval/list.html.twig')

            // this is used in 'edit' and 'new' pages to edit the field contents
            // you can use your own form types too
            ->setFormType(DateIntervalType::class)
            ->addCssClass('field-dateInterval')

            // these methods allow to define the web assets loaded when the
            // field is displayed in any CRUD page (index/detail/edit/new)
            //->addCssFiles('public/css/field-dateInterval.css')
            //->addJsFiles('js/admin/field-dateInterval.js')
            ;
    }

    /**
     * Get a DTO (Data Transfer Object) representation of the field.
     *
     * @return FieldDto The DTO representing the field.
     */
    public function getAsDto(): FieldDto {
        return $this->dto;
    }
}