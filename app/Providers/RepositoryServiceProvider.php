<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\ShopCategory\ShopCategoryRepositoryInterface::class,
            \App\Repositories\ShopCategory\ShopCategoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\Tag\TagRepositoryInterface::class,
            \App\Repositories\Tag\TagRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
