<?php

namespace App\Infrastructure\Validators\Product;

interface ItensValidatorInterface
{
    public function validate(array $item): array;
}
