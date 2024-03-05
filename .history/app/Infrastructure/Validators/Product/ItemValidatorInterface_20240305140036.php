<?php

namespace App\Infrastructure\Validator\Product;

interface ItemValidatorInterface
{
    public function validate(array $item): array;
}
