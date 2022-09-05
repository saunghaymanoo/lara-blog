<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
        Blade::if('isAdmin',function(){
            return Auth::user()->role == 'admin';
        });
        DB::listen(function($q){
            logger($q->sql);
        });
        View::composer([
            'index','detail','post.create','post.edit'
        ],function($view){
            $view->with('categories',Category::latest('id')->get());
        });
    }
}
