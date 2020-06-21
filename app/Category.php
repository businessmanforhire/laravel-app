<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Category extends Model implements Searchable
{
    use SoftDeletes;

    const visible=1;
    const not_visible=0;

    protected $fillable=['name','image','business_category_id','user_create_id','visible'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function getSearchResult(): SearchResult
    {
//        $url = route('categories.show', $this->id);

        return new SearchResult(
            $this,
            $this->name
//            $url
        );
    }

    public function business_category()
    {
        return $this->belongsTo(BusinessCategory::class);
    }

}
