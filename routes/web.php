<?php

use App\Http\Controllers\Backend\Admincontroller;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\frontendcontroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route:: get('/',[frontendcontroller::class,'index']);
Route:: get('/product-dettails',[frontendcontroller::class,'productDettails']);
Route:: get('/shop',[frontendcontroller::class,'shop']);
Route:: get('/return',[frontendcontroller::class,'return']);
Route:: get('/category-products',[frontendcontroller::class,'categoryProducts']);
Route:: get('/sub-category-products',[frontendcontroller::class,'subCategoryProducts']);
Route:: get('/checkout',[frontendcontroller::class,'checkout']);
Route:: get('/view-cart',[frontendcontroller::class,'viewCart']);

//policy
Route:: get('/privacy-policy',[frontendcontroller::class,'privacyPolicy']);
Route:: get('/terms-conditions',[frontendcontroller::class,'termsConditions']);
Route:: get('/refund-policy',[frontendcontroller::class,'refundPolicy']);
Route:: get('/payment-policy',[frontendcontroller::class,'paymentPolicy']);
Route:: get('/about-us',[frontendcontroller::class,'aboutUs']);
Route:: get('/contact-us',[frontendcontroller::class,'contactUs']);

//Admin login
Route::get('/admin/login',[Admincontroller::class,'adminlogin']);

Auth::routes();
Route::get('/admin/dashboard',[DashboardController::class,'admindashboard']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/logout',[Admincontroller::class,'adminlogout']);

// Categories
Route::get('/admin/CategoryList',[CategoryController::class,'categorylist']);
