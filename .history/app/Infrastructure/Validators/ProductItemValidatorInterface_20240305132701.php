<?php

namespace App\Infrastructure;

interface ItemValidatorInterface
{
    public function validate(array $item): array;
}
