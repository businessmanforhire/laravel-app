<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class BusinessCategory extends Model implements Searchable
{
    use SoftDeletes;

    const visible=1;
    const not_visible=0;

    public function business()
    {
        return $this->hasMany(BusinessInfo::class);
    }

    public function mobile_users()
    {
        return $this->belongsToMany('App\BusinessCategory');
    }

    public function getSearchResult(): SearchResult
    {

        return new SearchResult(
            $this,
            $this->name
        );
    }

    public function categories(){
        return $this->hasMany('App\Category');
    }


    public static function boot() {
        parent::boot();

        static::deleting(function($business_category) { // before delete() method call this
            $business_category->categories()->each(function($category) {
                $category->delete(); // <-- direct deletion
            });
        });
    }




}
