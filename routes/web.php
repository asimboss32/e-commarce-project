<?php

use App\Http\Controllers\Backend\Admincontroller;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\orderController;
use App\Http\Controllers\Backend\productController;
use App\Http\Controllers\Backend\subController;
use App\Http\Controllers\frontendcontroller;
use App\Models\order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route:: get('/',[frontendcontroller::class,'index']);
Route:: get('/product-dettails/{slug}',[frontendcontroller::class,'productDettails']);
Route:: get('/shop',[frontendcontroller::class,'shop']);
Route:: get('/return',[frontendcontroller::class,'return']);
Route:: get('/category-products/{id}',[frontendcontroller::class,'categoryProducts']);
Route:: get('/sub-category-products/{id}',[frontendcontroller::class,'subCategoryProducts']);
Route:: get('/checkout',[frontendcontroller::class,'checkout']);
Route:: get('/view-cart',[frontendcontroller::class,'viewCart']);
Route:: get('/Product-Details',[frontendcontroller::class,'productDetails']);
Route:: get('/View-All/{type}',[frontendcontroller::class,'viewAll']);

// search products

Route:: get('/search-products',[frontendcontroller::class,'searchProducts']);

//policy
Route:: get('/privacy-policy',[frontendcontroller::class,'privacyPolicy']);
Route:: get('/terms-conditions',[frontendcontroller::class,'termsConditions']);
Route:: get('/refund-policy',[frontendcontroller::class,'refundPolicy']);
Route:: get('/payment-policy',[frontendcontroller::class,'paymentPolicy']);
Route:: get('/about-us',[frontendcontroller::class,'aboutUs']);
Route:: get('/contact-us',[frontendcontroller::class,'contactUs']);

//add to cart
Route:: get('/add-to-cart/{id}',[frontendcontroller::class,'addToCart']);
Route:: post('/add-to-cart-dettails/{id}',[frontendcontroller::class,'addToCartDettails']);
Route:: get('/cart-Delete/{id}',[frontendcontroller::class,'addToCartDelete']);

//order confirmation routes
Route:: post('/confirm-order',[frontendcontroller::class,'confirmOrder']);
Route:: get('/order-confirmed/{invoiceId}',[frontendcontroller::class,'thankYou']);




//Admin login
Route::get('/admin/login',[Admincontroller::class,'adminlogin']);

Auth::routes();
Route::get('/admin/dashboard',[DashboardController::class,'admindashboard']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/logout',[Admincontroller::class,'adminlogout']);

// Categories
Route::get('/admin/CategoryList',[CategoryController::class,'categorylist']);
Route::get('/admin/CategoryCreate',[CategoryController::class,'categorycreate']);
Route::post('/admin/CategoryStore',[CategoryController::class,'categorystore']);
Route::get('/admin/Category/Delete/{id}',[CategoryController::class,'categorydelete']);
Route::get('/admin/Category/Edite/{id}',[CategoryController::class,'categoryedite']);
Route::post('/admin/Category/Update/{id}',[CategoryController::class,'categoryupdate']);

//subcategories
Route::get('/admin/Sub-Category/List',[subController::class,'subcategorylist']);
Route::get('/admin/Sub-Category/Create',[subController::class,'subCategoryCreate']);
Route::post('/admin/Sub-Category/Store',[subController::class,'subCategoryStore']);
Route::get('/admin/Sub-Category/Edite/{id}',[subController::class,'subCategoryEdite']);
Route::post('/admin/Sub-Category/Update/{id}',[subController::class,'subCategoryUpdate']);
Route::get('/admin/Sub-Category/Delete/{id}',[subController::class,'subCategoryDelete']);

//products
Route::get('/admin/product/List',[productController::class,'productList']);
Route::get('/admin/product/Create',[productController::class,'productCreate']);
Route::post('/admin/product/Store',[productController::class,'productStore']);
Route::get('/admin/product/Edite/{id}',[productController::class,'productEdite']);
Route::post('/admin/product/Update/{id}',[productController::class,'productUpdate']);
Route::get('/admin/product/Delete/{id}',[productController::class,'productDelete']);

//orders
Route::get('/admin/All-order/List',[orderController::class,'allOrderList']);
Route::get('/admin/order/Edite/{id}',[orderController::class,'orderEdite']);
Route::post('/admin/order/Update/{id}',[orderController::class,'orderUpdate']);
Route::get('/admin/order/Update-Status/{status}/{id}',[orderController::class,'orderUpdateStatus']);