<?php

namespace App\Providers;

use App\Services\Categories\CategoryService;
use App\Services\Categories\CategoryServiceInterface;
use App\Services\Posts\PostService;
use App\Services\Posts\PostServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
