<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class BusinessInfo extends Model implements Searchable
{
    use SoftDeletes;

    protected $fillable = ['business_name'];


    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function category()
    {
        return $this->belongsTo(BusinessCategory::class,'business_category_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function reviews()
    {
        return $this->belongsTo(Review::class);
    }

    public function product_reviews()
    {
        return $this->belongsTo(ProductReview::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getSearchResult(): SearchResult
    {

        return new SearchResult(
            $this,
            $this->business_name
        );
    }

    public function business_images()
    {
        return $this->hasMany(BusinessImage::class,'business_id');
    }

    public function subscription()
    {
        return $this->belongsTo('App\BusinessSubscription','business_id');
    }
}
