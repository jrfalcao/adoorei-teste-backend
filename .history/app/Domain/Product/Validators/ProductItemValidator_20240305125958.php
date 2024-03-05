<?php

namespace App\Domain\Products\Validators;

class ProductItemValidator
{
    public function validate(array $item): array
    {
        $errors = [];

        if (empty($item['name'])) {
            $errors['name'] = 'O nome do item não pode ser vazio.';
        }

        if (strlen($item['name']) > 255) {
            $errors['name'] = 'O nome do produto não pode ter mais de 255 caracteres.';
        }

        if ($item['price'] <= 0) {
            $errors['price'] = 'O preço do produto deve ser maior que zero.';
        }

        if (!is_numeric($item['price'])) {
            $errors['price'] =  'O preço do produto deve ser um número decimal válido.';
        }

        if (!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $item['price'])) {
            $errors['price'] = 'O preço do produto deve ser um número com até 2 casas decimais.';
        }

        if (!is_integer($item['quantity'])) {
            $errors['quantity'] = 'A quantidade do item deve ser um número.';
        }

        if ($item['quantity'] <= 0) {
            $errors['quantity'] = 'A quantidade do item deve ser maior que zero.';
        }

        return $errors;
    }
}
