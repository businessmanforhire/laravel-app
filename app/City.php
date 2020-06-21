<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function business()
    {
        return $this->hasMany(BusinessInfo::class);
    }
}
