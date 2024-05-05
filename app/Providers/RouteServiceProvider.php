<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function () {
            $this->getRouteParameters()->each(function ($params) {
                $this->mapRoutes($params);
            });
        });
    }

    private function mapRoutes($params)
    {
        collect(File::files(base_path('routes/'.$params['dir'])))->each(function ($file) use ($params) {
            Route::prefix($params['prefix'])
                ->name($params['name'])
                ->middleware($params['middleware'])
                ->namespace($this->namespace)
                ->group($file);
        });
    }

    private function getRouteParameters(): Collection
    {
        return collect([
            'auth'          =>  ['dir' => 'auth', 'prefix' => 'auth', 'name' => '', 'middleware' => 'api'],
            'categories'    =>  ['dir' => 'categories', 'prefix' => 'categories', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'common'        =>  ['dir' => 'common', 'prefix' => 'common', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'disciplines'   =>  ['dir' => 'disciplines', 'prefix' => 'disciplines', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'divisions'     =>  ['dir' => 'divisions', 'prefix' => 'divisions', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'questions'     =>  ['dir' => 'questions', 'prefix' => 'questions', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'roles'         =>  ['dir' => 'roles', 'prefix' => 'roles', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'surveys'       =>  ['dir' => 'surveys', 'prefix' => 'surveys', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'users'         =>  ['dir' => 'users', 'prefix' => 'users', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'public'        =>  ['dir' => 'public', 'prefix' => 'public', 'name' => '', 'middleware' => 'api'],
        ]);
    }
}
