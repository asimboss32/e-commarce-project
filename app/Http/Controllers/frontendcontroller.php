<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontendcontroller extends Controller
{
    public function index()
    {
        return view ('index');
    }
    public function shop()
    {
        return view ('shop');
    }
    public function return()
    {
        return view ('return');
    }
    public function categoryProducts()
    {
        return view ('categoryproducts');
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
    public function productDetails()
    {
        return view ('details');
    }
    public function viewAll()
    {
        return view ('viewall');
    }
}