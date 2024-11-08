<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\Product\ProductAdminService;
use App\Http\Services\Product\ProductService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind your services
        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductService();
        });

        $this->app->singleton(ProductAdminService::class, function ($app) {
            return new ProductAdminService($app->make(ProductService::class));
        });
    }
}
