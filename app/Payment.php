<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $fillable = [
        'codigo',
        'name',
        'email',
        'quantity',
        'amount',
        'collection_id',
        'collection_status',
        'payment_type',
        'merchant_order_id',
        'preference_id',
        'estatus',
    ];

}
