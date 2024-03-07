<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

class SaleProducts extends Model
{
    protected $table = 'sale_products';

    protected $primaryKey = ['sale_id', 'product_id'];

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unitary_value',
    ];

    public function sale()
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
