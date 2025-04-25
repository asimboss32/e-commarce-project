<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class subController extends Controller
{
    public function subcategorylist()
    {    $subcategories = SubCategory:: with('category')-> get();
       
        return view('Backend.subcategory.list',compact('subcategories'));
    }

    public function subCategoryCreate()
    {
        $categories = Category::orderBy('name','asc')-> get();
        
        return view('Backend.subcategory.create',compact('categories'));
    }
    public function subCategoryStore(Request $request)
    {
        $subcategory = new SubCategory();
        $subcategory->cate_id = $request->cate_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);  
        $subcategory->save();
    //    dd($subcategory);
        return redirect('/admin/Sub-Category/List');
    }
}
