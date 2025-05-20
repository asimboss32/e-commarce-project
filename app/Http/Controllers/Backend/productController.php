<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\GalleryImage;
use App\Models\Products;
use App\Models\Review;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function productCreate()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return view('Backend.product.create', compact('categories', 'subcategories'));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cate_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:sub_categories,id',
            'sku_code' => 'required|string|max:100',
            'buying_price' => 'required|numeric',
            'reguler_price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'qty' => 'required|integer',
            'description' => 'nullable|string',
            'policy' => 'nullable|string',
            'product_type' => 'nullable|string',
            'image' => 'nullable|image',
            'galleryimage.*' => 'nullable|image',
        ]);

        $product = new Products();

        if ($request->hasFile('image')) {
            $imageName = rand() . "-product." . $request->image->extension();
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

        // Save colors
        if (!empty($request->color)) {
            foreach ($request->color as $name) {
                if ($name !== null) {
                    Color::create([
                        'product_id' => $product->id,
                        'name' => $name,
                    ]);
                }
            }
        }

        // Save sizes
        if (!empty($request->size)) {
            foreach ($request->size as $name) {
                if ($name !== null) {
                    Size::create([
                        'product_id' => $product->id,
                        'name' => $name,
                    ]);
                }
            }
        }

        // Save gallery images
        if ($request->hasFile('galleryimage')) {
            foreach ($request->galleryimage as $image) {
                $imageName = rand() . '-galleryimage.' . $image->extension();
                $image->move('backend/images/galleryimage', $imageName);

                GalleryImage::create([
                    'product_id' => $product->id,
                    'image' => $imageName,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Product created successfully.');
    }

    public function productList()
    {
        $products = Products::with('category', 'subcategory')->orderByDesc('id')->get();

        return view('Backend.product.list', compact('products'));
    }

    public function productDelete($id)
    {
        $product = Products::find($id);
      
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Delete product image
        if ($product->image && file_exists('backend/images/products/' . $product->image)) {
            unlink('backend/images/products/' . $product->image);
        }

        // Delete related colors
        Color::where('product_id', $product->id)->delete();

        // Delete related sizes
        Size::where('product_id', $product->id)->delete();

        // Delete related reviews
        Review::where('product_id', $product->id)->delete();

        // Delete related gallery images and their files
        $galleryImages = GalleryImage::where('product_id', $product->id)->get();
        foreach ($galleryImages as $image) {
            if ($image->image && file_exists('backend/images/galleryimage/' . $image->image)) {
                unlink('backend/images/galleryimage/' . $image->image);
            }
            $image->delete();
        }

        $product->delete();

      
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
    
    public function productEdite($id)
    {
        $product = Products:: where('id',$id)->with('color','size','galleryimage')->first();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view ('Backend.product.edite',compact('product','categories','subcategories'));
    }
    public function productUpdate(Request $request,$id)
    {
        $product = Products::find($id);
        if (isset($request->image)){
            if ($product->image && file_exists('backend/images/products/' . $product->image)) {
                unlink('backend/images/products/' . $product->image);
            }

            $imageName = rand() . "-product." . $request->image->extension();
            $request->image->move('backend/images/products', $imageName);
            $product->image = $imageName;
        }
          if(isset($request->galleryimage)){

            $images = GalleryImage::where('product_id', $product->id)->get();

            if($images->isNotEmpty()){
                foreach($images as $singleImage){
                    if($singleImage->image && file_exists('backend/images/galleryimage/'.$singleImage->image)){
                        unlink('backend/images/galleryimage/'.$singleImage->image);
                    }
    
                    $singleImage->delete();
    
                }
    
                foreach($request->galleryimage as $image){
                    $galleryImage = new GalleryImage();
    
                    $galleryImage->product_id = $product->id;
    
                    $imageName = rand().'-galleryimage-'.'.'.$image->extension(); // 85778-galleryimage-.jpg
                    $image->move('backend/images/galleryimage/',$imageName);
    
                    $galleryImage->image = $imageName;
                    $galleryImage->save();
                }
            }
        }
        // Save colors
         Color::where('product_id', $product->id)->delete();
        if (!empty($request->color)) {
            foreach ($request->color as $name) {
                if ($name !== null) {
                    Color::create([
                        'product_id' => $product->id,
                        'name' => $name,
                    ]);
                }
            }
        }

        // Save sizes
        Size::where('product_id', $product->id)->delete();
        if (!empty($request->size)) {
            foreach ($request->size as $name) {
                if ($name !== null) {
                    Size::create([
                        'product_id' => $product->id,
                        'name' => $name,
                    ]);
                }
            }
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
       return redirect()->back();
    }
}

