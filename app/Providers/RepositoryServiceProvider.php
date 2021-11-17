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

        $this->app->bind(
            \App\Repositories\Province\ProvinceRepositoryInterface::class,
            \App\Repositories\Province\ProvinceRepository::class
        );

        $this->app->bind(
            \App\Repositories\District\DistrictRepositoryInterface::class,
            \App\Repositories\District\DistrictRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopCustomer\ShopCustomerRepositoryInterface::class,
            \App\Repositories\ShopCustomer\ShopCustomerRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopOrder\ShopOrderRepositoryInterface::class,
            \App\Repositories\ShopOrder\ShopOrderRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopOrderDetail\ShopOrderDetailRepositoryInterface::class,
            \App\Repositories\ShopOrderDetail\ShopOrderDetailRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopOrderStatus\ShopOrderStatusRepositoryInterface::class,
            \App\Repositories\ShopOrderStatus\ShopOrderStatusRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopPaymentStatus\ShopPaymentStatusRepositoryInterface::class,
            \App\Repositories\ShopPaymentStatus\ShopPaymentStatusRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopShippingStatus\ShopShippingStatusRepositoryInterface::class,
            \App\Repositories\ShopShippingStatus\ShopShippingStatusRepository::class
        );

        $this->app->bind(
            \App\Repositories\Ward\WardRepositoryInterface::class,
            \App\Repositories\Ward\WardRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopTax\ShopTaxRepositoryInterface::class,
            \App\Repositories\ShopTax\ShopTaxRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopBanner\ShopBannerRepositoryInterface::class,
            \App\Repositories\ShopBanner\ShopBannerRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopNews\ShopNewsRepositoryInterface::class,
            \App\Repositories\ShopNews\ShopNewsRepository::class
        );

        $this->app->bind(
            \App\Repositories\Tag\TagRepositoryInterface::class,
            \App\Repositories\Tag\TagRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopComment\ShopCommentRepositoryInterface::class,
            \App\Repositories\ShopComment\ShopCommentRepository::class
        );

        $this->app->bind(
            \App\Repositories\ShopConfig\ShopConfigRepositoryInterface::class,
            \App\Repositories\ShopConfig\ShopConfigRepository::class
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
