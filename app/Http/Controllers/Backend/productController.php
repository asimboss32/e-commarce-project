<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\GalleryImage;
use App\Models\Products;
use App\Models\Size;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class productController extends Controller
{
    public function productCreate()
    {
        $categories = Category::get();
        $subcategories = SubCategory::get();

        return View('Backend.product.create', compact('categories', 'subcategories'));
    }

    public function productStore(Request $request)
    {
        $product = new Products();

        if (isset($request->image)) {
            $imageName = rand() . "-product-." . $request->image->extension(); //image insert
            $request->image->move('backend/images/products', $imageName);
            $product->image = $imageName;
        }
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->cate_id = $request->cate_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->sku_code = $request->sku_code;
        $product->buying_price = $request->buying_price;
        $product->reguler_price = $request->reguler_price;
        $product->discount_price = $request->discount_price;
        $product->qty = $request->qty;
        $product->description = $request->description;
        $product->policy = $request->policy;
        $product->product_type = $request->product_type;
      
        $product->save();

        // Add color
        if(isset($request->color) && $request->color[0] !=null){
            foreach($request->color as $name){
                $color = new Color();
                $color->product_id = $product->id;
                $color->name = $name;

                $color->save();
            }
        }
        // Add size
        if(isset($request->size) && $request->size[0] !=null){
            foreach($request->size as $name){
                $size = new Size();  //----------MODEL NAME --------
                $size->product_id = $product->id;
                $size->name = $name;

                $size->save();
            }
        }
        //GALLERY IMAGE
        if(isset($request->galleryimage)){
            foreach($request->galleryimage as $image){
                $galleryimage = new GalleryImage();  //----------MODEL NAME --------
                $galleryimage->product_id = $product->id;
                
                $imageName = rand().'-galleryimage-'.'.'.$image->extension(); //image insert
                $image->move('backend/images/galleryimage', $imageName);
                
                $galleryimage->image = $imageName;
                $galleryimage->save();
            }
        }

        return redirect()->back();
    }

    public function productList()
    {
        $products = Products::orderBy('id','desc')->with('category','subcategory')->get();
        
        return view ('Backend.product.list', compact('products'));
    }

    
}
