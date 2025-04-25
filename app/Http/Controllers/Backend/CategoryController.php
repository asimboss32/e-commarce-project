<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categorylist()
    {
        $categories = Category::get();
        return view('Backend.category.list', compact('categories'));
    }

    public function categorycreate()
    {
        return view('Backend.category.create');
    }

    public function categorystore(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);  //Fix capitalization

        if (isset($request->image)) {
            $imageName = rand() . "-category-.". $request->image->extension(); //image insert
            $request->image->move('backend/images/category', $imageName);
            $category->image = $imageName;
        }

        $category->save();
        return redirect('/admin/CategoryList');
    }


    public function categorydelete($id)
    {
        $category = Category::find($id);// id tule anar jonno

        if ($category->image && file_exists('backend/images/category/' . $category->image)) {  //image delete from path
            unlink('backend/images/category/' . $category->image);
        }

        $category->delete();
        return redirect()->back();
    }

    public function categoryedite($id)
    {
        $category = Category::find($id);
        return view('Backend.category.edite', compact('category'));
    }
    public function categoryupdate(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if (isset($request->image)) {
            if ($category->image && file_exists('backend/images/category/' . $category->image)) {  //image delete from path
                unlink('backend/images/category/' . $category->image);
            }
            $imageName = rand() . "-categoryupdate-".'.'. $request->image->extension(); //image insert
            $request->image->move('backend/images/category', $imageName);

            $category->image = $imageName;
        }
        $category->save();
        return redirect()->back();
    }
}
