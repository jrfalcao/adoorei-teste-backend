<?php

namespace App\Infrastructure\Validators\Product;

use Illuminate\Validation\Factory;
use App\Infrastructure\Validators\Product\ItemValidatorInterface;

class ProductItemValidator implements ItemValidatorInterface
{
    private $validatorFactory;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function validate(array $item): array
    {
        $validator = $this->validatorFactory->make($item, [
            'name' => 'required',
            'quantity' => 'numeric|min:1',
        ]);

        return $validator->errors()->all();
    }
}
