<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessImage extends Model
{
    public function business()
    {
        return $this->belongsTo(BusinessInfo::class,'user_id');
    }
}
