<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Article;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('partials.nav', function ($view)
        {
            $view->with('Categories', Category::all());

            //dd($view);
        });

        view()->composer('partials.bestArticlesAndArchive', function ($view)
        {
            $view->with('bestArticles', Article::BestArticles());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
