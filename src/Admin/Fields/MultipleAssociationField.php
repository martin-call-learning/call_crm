<?php

namespace App\Admin\Fields;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class MultipleAssociationField implements FieldInterface {

    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null) {
        // TODO: Implement new() method.
    }

    public function getAsDto(): FieldDto {
        return $this->dto;
    }
}