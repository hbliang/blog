<?php

namespace App\Providers;

use App\Category;
use App\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.sidebar', function ($view) {
            $tags = Tag::inRandomOrder()
                ->take(12)
                ->get();

            $categories = Category::inRandomOrder()
                ->take(12)
                ->get();

            $view->with([
                'tags' => $tags,
                'categories' => $categories,
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
