<?php

namespace App\Utils;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AssociationCollectionType extends CollectionType
{

    private EntityType $secondParent;

    public function __construct() {
        $this->secondParent = new EntityType();
    }

}