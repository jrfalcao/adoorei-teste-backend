<?php

namespace App\Infrastructure\Validators\Product;

use Illuminate\Validation\Factory;
use App\Infrastructure\Validators\Product\ItensValidatorInterface;

class ValidateItens implements ItensValidatorInterface
{
    private $validatorFactory;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function validate(array $itens): array
    {
        $itens = (is_object($itens) ) ? get_object_vars($itens) : $itens;
        $validator = $this->validatorFactory->make($itens, [
            'name' => 'required',
            'quantity' => 'numeric|min:1',
        ]);

        return $validator->errors()->all();
    }
}
