<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {

            $allCategories = Category::all();

            $priority_categories = $allCategories->take(5);
            $other_categories = $allCategories->skip(5);

            $view->with('priority_categories', $priority_categories);
            $view->with('other_categories', $other_categories);
        });
    }
}
