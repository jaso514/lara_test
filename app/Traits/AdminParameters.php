<?php

namespace App\Traits;

trait AdminParameters
{
    public string $entity = "";

    public function setEntity($entity) {
        $this->entity = $entity;
    }
}