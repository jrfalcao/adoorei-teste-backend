<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    /**
     *
     * @var string
     */
    protected $table = 'sales';

    use SoftDeletes;

    /**
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'sale_date',
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsToMany(Product::class, 'sale_product', 'sale_id', 'product_id');
    }
}
