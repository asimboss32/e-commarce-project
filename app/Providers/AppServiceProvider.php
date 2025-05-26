<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
           $view->with('cartProducts',Cart::where('ip_address',request()->ip())->with('product')->get()); 
           $view->with('cartCount',Cart::where('ip_address',request()->ip())->with('product')->count()); 
            $view->with('categoriesGlobal',Category::with('subcategory')->get());
            $view->with('subCategoriesGlobal',subCategory::get());
        });
    }
}
