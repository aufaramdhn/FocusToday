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
        // $this->app->usePublicPath(base_path('../public_html'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $allCategories = Category::all();
            $priority_categories = $allCategories->take(8);
            $other_categories = $allCategories->skip(8);

            $footer_categories = Category::whereHas('articles')
                ->inRandomOrder()
                ->take(3)
                ->get();

            $view->with('priority_categories', $priority_categories);
            $view->with('other_categories', $other_categories);
            $view->with('footer_categories', $footer_categories);
        });
    }
}
