<?php

namespace App\Providers;

use App\Shop;
use App\Category;
use App\Observers\ShopObserver;
use Illuminate\Support\Facades\Schema;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Voyager::useModel('Category', \App\Category::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {  
        Paginator::useBootstrap();
        Shop::observe(ShopObserver::class);

        if(Schema::hasTable('categories')) {

            $categories = cache()->remember('categories','3600', function(){
                return Category::whereNull('parent_id')->get();
            });
            // dd($categories);
            view()->share('categories', $categories);
        }  

    }
}
