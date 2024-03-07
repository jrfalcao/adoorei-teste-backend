<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Model
{
    use SoftDeletes;

    protected $table = 'sale_product';

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unitary_value',
    ];
}
