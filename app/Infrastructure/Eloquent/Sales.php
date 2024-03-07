<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    /**
     *
     * @var string
     */
    protected $table = 'sales';

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
        return $this->belongsTo(Product::class);
    }
}
