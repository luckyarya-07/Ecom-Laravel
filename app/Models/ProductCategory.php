<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name'];

  public function children()
  {
    return $this->hasMany('App\Models\ProductCategory', 'parent_id');
  }

  public function product()
  {
    return $this->hasMany('App\Models\Product');
  }
}
