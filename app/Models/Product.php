<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['user_id', 'category_id', 'title', 'slug', 'featured_img', 'multi_img', 'sku', 'mrp_price', 'sale_price', 'discount', 'dis_percentage', 'short_description', 'specification', 'description'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsTo('App\Models\ProductCategory');
    }

    public function setFeaturedimgAttribute($value)
    {
        $this->attributes['featured_img'] = json_encode($value);
    }
}
