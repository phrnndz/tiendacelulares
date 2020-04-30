<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
            'name','description','price','status','photo'
    ];
    protected $appends = ['slug'];


    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    



    

}
