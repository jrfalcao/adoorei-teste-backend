<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Os atributos que são mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'description',
        'quantity',
    ];

    /**
     * O relacionamento com a tabela de sale.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sale()
    {
        return $this->belongsToMany(SaleProducts::class, 'sale_product', 'product_id', 'sale_id');
    }
}
