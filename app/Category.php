<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'nombre'
    ];

    public function products()
    {
        return $this->hasMany('App\Product','category_id');
    }
}
