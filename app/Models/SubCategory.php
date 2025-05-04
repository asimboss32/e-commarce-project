<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    use HasFactory;
    protected $fillable=['name','cat_id','slug'];

    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id','id');
    }
    public function product()
    {
        return $this->hasMany(subCategory::class,'sub_cat_id','id');
    }

}
