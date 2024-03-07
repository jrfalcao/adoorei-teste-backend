<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

class SaleProducts extends Model
{
    protected $table = 'sale_product';

    protected $primaryKey = ['sale_id', 'product_id'];

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unitary_value',
    ];
}
