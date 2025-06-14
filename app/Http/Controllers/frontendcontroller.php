<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\order;
use App\Models\orderdettails;
use App\Models\Products;
use App\Models\subCategory;
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
    public function shop(Request $request)
    {
        if(isset($request->cate_id)){
          $products = Products::orderBy('id','desc')->where('cate_id', $request->cate_id)->get();
        }
         elseif(isset($request->sub_cat_id)){
          $products = Products::orderBy('id', 'desc')->where('sub_cat_id',$request->sub_cat_id)->get();
        }
        else{
            $products = Products::orderBy('id', 'desc')->get();

        }
         $productsCount = $products->count();
        return view ('shop',compact('products','productsCount'));
    }
    public function return()
    {
        return view ('return');
    }
    public function categoryProducts($id)
    {   
        $category = Category::find($id);
        $products = Products::where('cate_id',$id)->get();
        $productsCount = Products::where('cate_id',$id)->count();
        return view ('categoryproducts',compact('products','category','productsCount'));
    }
    public function subCategoryProducts($id)
    {
        $subCategory = subCategory::find($id);
        $products = Products::where('sub_cat_id',$id)->get();
        $productsCount = Products::where('sub_cat_id',$id)->count();
        return view ('subcategoryproducts',compact('products','subCategory','productsCount'));
    }

    public function searchProducts(Request $request)
    {
        $products = Products::where('name', 'LIKE', '%'.$request->search.'%')->get();
        $productsCount = $products->count();
        return view('searchProducts', compact('products', 'productsCount'));
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
    public function viewAll($type)
    {
         $products = Products::where('product_type', $type)->get();
         $productsCount = Products::where('product_type', $type)->count();
        return view ('viewall',compact('products', 'type', 'productsCount'));
    }

    //cart function
    public function addToCart (Request $request,$id)
    {
        $cartProduct = Cart::where('product_id', $id)->where('ip_address', $request->ip())->orderBy('id', 'desc')->first();
        $product = Products::find($id);

        if($cartProduct == null){
            $cart = new Cart();
            $cart->ip_address = $request->ip();
            $cart->product_id = $product->id;
            $cart->qty = 1;
            
            if($product->discount_price == null){
                $cart->price = $product->regular_price;
            }
            elseif($product->discount_price != null){
                $cart->price = $product->discount_price;
            }

            $cart->save();
        }

        elseif($cartProduct != null){
            $cartProduct->qty =$cartProduct->qty + 1;
            $cartProduct->save();
        }
        
        return redirect()->back();
    }

   
    public function addToCartDettails(Request $request, $id)

    {
    $cartProduct = Cart::where('product_id', $id)
        ->where('ip_address', $request->ip())
        ->orderBy('id', 'desc')
        ->first();

    $product = Products::find($id);

    if ($cartProduct == null) {
        $cart = new Cart();
        $cart->ip_address = $request->ip();
        $cart->product_id = $product->id;
        $cart->qty = 1;
        $cart->color = $request->color;
        $cart->size = $request->size;

        if ($product->discount_price == null) {
            $cart->price = $product->regular_price;
        } elseif ($product->discount_price != null) {
            $cart->price = $product->discount_price;
        }

        $cart->save();
    }
     elseif($cartProduct != null){
            $cartProduct->qty =$cartProduct->qty + $request->qty ;
            $cartProduct->color = $request->color;
            $cartProduct->size = $request->size;
            $cartProduct->save();
        }
        
      if($request->action == "addToCart"){
            return redirect()->back();
        }
         if($request->action == "buyNow"){
            return redirect('/checkout');
        }
}
   public function addToCartDelete($id)
     {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
     }

    //  confirm order

    public function confirmOrder(Request $request)
    {
        $order = new order();

        $previousOrder = order::orderBy('id','desc')->first();

        if($previousOrder == null){
            $generateInvoice = "XYZ-1";
            $order->invoiceId = $generateInvoice;
        }
           else{
                $generateInvoice = "XYZ-1".$previousOrder->id+1;
            $order->invoiceId = $generateInvoice;
         
        }
        $order->c_name = $request->c_name;
         $order->c_phone = $request->c_phone;
         $order->address = $request->address;
         $order->area = $request->area;
        $order->price = $request->grandTotalHidden;

        $cartProducts = Cart::where('ip_address',$request->ip())->get();
        if($cartProducts->isNotEmpty()){  
           $order->save();


           foreach($cartProducts as $cart){
            $orderDettails = new orderdettails();

            $orderDettails->order_id = $order->id;
              $orderDettails->product_id = $cart->product_id;
              $orderDettails->size = $cart->size;
            $orderDettails->color = $cart->color;
            $orderDettails->qty = $cart->qty;
            $orderDettails->price = $cart->price;

             $orderDettails->save();
            $cart->delete();

           }
        }

        else{
            return redirect()->back();
        }
        return redirect('order-confirmed/'.$generateInvoice);
    }

    public function thankYou($invoiceId)
    {
      return view('thaankyou',compact('invoiceId'));
    }
}