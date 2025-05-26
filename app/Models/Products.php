<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id','id');
    }
    public function subcategory()
    {
        return $this->belongsTo(subCategory::class,'sub_cat_id','id');
    }
    public function size()
    {
        return $this->hasMany(size::class,'product_id','id');
    }
    public function color()
    {
        return $this->hasMany(Color::class,'product_id','id');
    }
    public function galleryimage()
    {
        return $this->hasMany(GalleryImage::class,'product_id','id');
    }
    public function review()
    {
        return $this->hasMany(Review::class,'product_id','id');
    }
      public function cart()
    {
        return $this->hasMany(Cart::class,'product_id','id');
    }
}
