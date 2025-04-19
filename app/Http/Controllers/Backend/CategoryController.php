<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categorylist ()
    {
        $categories= Category::get();
        
        return view ('Backend.category.list', compact('categories'));
    }
}
