<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    const visible=1;
    const not_visible=0;
    
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }

}
