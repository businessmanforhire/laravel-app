<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Product extends Model implements Searchable
{
    protected $fillable = ['name','description','image','price','quantity','category_id','business_id','user_create_id','is_specific'];

    const visible=1;
    const not_visible=0;

    const is_offer=1;
    const not_offer=0;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function business()
    {
        return $this->belongsTo(BusinessInfo::class,'business_id','user_id');
    }

    public function getSearchResult(): SearchResult
    {

        return new SearchResult(
            $this,
            $this->name
        );
    }

    public function product_size()
    {
        return $this->hasMany(ProductSize::class);
    }

}
