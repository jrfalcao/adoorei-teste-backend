<?php

namespace App\Infrastructure\Validators\Product;

use App\Domain\Product\Entity\Product;

interface ItensValidatorInterface
{
    public function validate(array $itens): array;
}
