<?php

namespace App\Providers;

use App\Http\Interfaces\CommonInterface;
use App\Http\Interfaces\RoleInterface;
use App\Services\CommonService;
use App\Services\RoleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleInterface::class, RoleService::class);
        $this->app->bind(CommonInterface::class, CommonService::class);
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
