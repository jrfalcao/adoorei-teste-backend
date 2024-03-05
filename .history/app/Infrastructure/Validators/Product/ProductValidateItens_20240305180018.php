<?php

namespace App\Infrastructure\Validators\Product;

use App\Domain\Product\Entity\Product;
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
            'name' => 'required',
            'quantity' => 'numeric|min:1',
            'price' => 'numeric|min:0',
        ]);

        return $validator->errors()->all();
    }
}
