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
            \App\Repositories\ShopProduct\ShopProductRepositoryInterface::class,
            \App\Repositories\ShopProduct\ShopProductRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopAttributeGroup\ShopAttributeGroupRepositoryInterface::class,
            \App\Repositories\ShopAttributeGroup\ShopAttributeGroupRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopBrand\ShopBrandRepositoryInterface::class,
            \App\Repositories\ShopBrand\ShopBrandRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopLengthClass\ShopLengthClassRepositoryInterface::class,
            \App\Repositories\ShopLengthClass\ShopLengthClassRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopProductAttribute\ShopProductAttributeRepositoryInterface::class,
            \App\Repositories\ShopProductAttribute\ShopProductAttributeRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopSupplier\ShopSupplierRepositoryInterface::class,
            \App\Repositories\ShopSupplier\ShopSupplierRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopWeightClass\ShopWeightClassRepositoryInterface::class,
            \App\Repositories\ShopWeightClass\ShopWeightClassRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopProductImage\ShopProductImageRepositoryInterface::class,
            \App\Repositories\ShopProductImage\ShopProductImageRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopProductPromotion\ShopProductPromotionRepositoryInterface::class,
            \App\Repositories\ShopProductPromotion\ShopProductPromotionRepository::class
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
