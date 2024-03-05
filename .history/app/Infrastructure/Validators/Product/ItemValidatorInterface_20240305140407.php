<?php

namespace App\Infrastructure\Validators\Product;

interface ItemValidatorInterface
{
    public function validate(array $item): array;
}
