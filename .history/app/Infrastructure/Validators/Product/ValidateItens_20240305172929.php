<?php

namespace App\Infrastructure\Validators\Product;

use App\Domain\Product\Entity\Product;
use Illuminate\Validation\Factory;
use App\Infrastructure\Validators\Product\ItensValidatorInterface;

class ValidateItens implements ItensValidatorInterface
{
    private $validatorFactory;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function validate(Product $product): array
    {
        $itens = (is_object($product) ) ? get_object_vars($product) : $product;
        $validator = $this->validatorFactory->make($itens, [
            'name' => 'required',
            'quantity' => 'numeric|min:1',
            'price' => 'numeric|min:0',
        ]);

        return $validator->errors()->all();
    }
}
