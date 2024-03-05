<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'sales';

    /**
     * Os atributos que são mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'amount',
    ];

    /**
     * O relacionamento com a tabela de vendas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
{
    return $this->belongsTo(Product::class);
}
}
