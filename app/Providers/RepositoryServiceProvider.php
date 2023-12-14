<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $models = array(
            'User',
            'Shop',
            'Product',
            'Category',
            'Order',
            'City',
        );

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\\$model\\$model"."RepositoryInterface", "App\Repositories\\$model\\$model"."Repository");
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
