<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class frontendcontroller extends Controller
{
    public function index()
    {
       $hotProducts = Products::where('product_type','hot')->orderBy('id','desc')->get();
       $newProducts = Products::where('product_type','new')->orderBy('id','desc')->get();
       $ragularProducts = Products::where('product_type','reguler')->orderBy('id','desc')->get();
       $discountProducts = Products::where('product_type','discount')->orderBy('id','desc')->get();
       $categories = Category::orderBy('id','desc')->get();
       return view('index',compact('hotProducts','newProducts','ragularProducts','discountProducts','categories'));
    }
    public function shop()
    {
        return view ('shop');
    }
    public function return()
    {
        return view ('return');
    }
    public function categoryProducts($id)
    {   
        $category = Category::find($id);
        $product = Products::where('cate_id',$id)->get();
        $productsCount = Products::where('cate_id',$id)->count();
        return view ('categoryproducts',compact('product','category','productsCount'));
    }
    public function subCategoryProducts()
    {
        return view ('subcategoryproducts');
    }

    public function checkout()
    {
        return view ('checkout');
    }
    public function viewCart()
    {
        return view ('viewcart');
    }
    public function privacyPolicy()
    {
        return view ('privacypolicy');
    }
    public function termsConditions()
    {
        return view ('termsconditions');
    }
    public function refundPolicy()
    {
        return view ('refundpolicy');
    }
    public function paymentPolicy()
    {
        return view ('paymentpolicy');
    }
    public function aboutUs()
    {
        return view ('aboutus');
    }
    public function contactUs()
    {
        return view ('contactus');
    }
    public function productDettails ($slug)
    {    
        $product = Products::with ('color','size','galleryimage','review')->where ('slug',$slug)->first();
        $categories = Category::orderBy('slug','desc')->get();
        return view ('details', compact('product','categories'));
    }
    public function viewAll()
    {
        return view ('viewall');
    }
}