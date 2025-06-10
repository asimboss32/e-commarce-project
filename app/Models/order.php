<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
   protected $guarded = [];
      public function orderdettails()
    {
        return $this->hasMany(orderdettails::class,'order_id','id')->with('Products');
    }
}
