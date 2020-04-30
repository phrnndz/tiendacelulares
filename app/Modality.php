<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    //
    protected $fillable = [
        'nombre'
    ];

    public function products()
    {
        return $this->hasMany('App\Product','modality_id');
    }
}
