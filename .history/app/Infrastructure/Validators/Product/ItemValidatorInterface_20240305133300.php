<?php

namespace App\Infrastructure;

interface ProductItemValidatorInterface
{
    public function validate(array $item): array;
}
