<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['name', 'slug','image'];

    public function subcategory()
    {
        return $this->hasMany(subCategory::class,'cate_id','id');
    }
    public function product()
    {
        return $this->hasMany(Products::class,'	cate_id','id');
    }
}
