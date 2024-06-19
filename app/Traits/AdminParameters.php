<?php

namespace App\Traits;

trait AdminParameters
{
    public string $entity = "";

    public function setEntity($entity) {
        $this->entity = $entity;
    }

    public function getHead() {
        return [
            ['label' => 'Actions', 'no-export' => true, 'width' => 5]
        ];
    }
}