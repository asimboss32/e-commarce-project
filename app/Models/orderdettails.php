<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderdettails extends Model
{
    use HasFactory;
     protected $guarded = [];

      public function products()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }
       public function order()
    {
        return $this->belongsTo(order::class,'order_id','id');
    }
}
