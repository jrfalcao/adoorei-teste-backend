<?php

namespace App\Infrastructure\Validators\Product;

use Illuminate\Validation\Factory;
use App\Infrastructure\Validators\Product\ItensValidatorInterface;

class ProductValidateItens implements ItensValidatorInterface
{
    private $validatorFactory;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function validate(array $itens): array
    {
        $validator = $this->validatorFactory->make($itens, [
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
            'quantity' => 'required|numeric|min:1',
        ]);

        return $validator->errors()->all();
    }
}
