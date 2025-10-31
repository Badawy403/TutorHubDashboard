<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/super_admin/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::
            name('api.')
                ->prefix('api/v1')
                ->group(base_path('routes/api.php'));

            Route::middleware(['installer','web'])
                ->group(base_path('routes/web.php'));
            Route::middleware(['installer','web'])
                ->group(base_path('routes/super_admins.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?? $request->ip());
        });
        Route::macro('crudRoutes', function ($uri, $controller) {
            Route::get("{$uri}/export", "{$controller}@export")->name("{$uri}.export");
            Route::post("{$uri}/import", "{$controller}@import")->name("{$uri}.import");
            $singular = Str::of($uri)->singular();
            Route::put("{$uri}/updateStatus/{{$singular}}", "{$controller}@updateStatus")->name("{$uri}.update_status");
            Route::post("{$uri}/filter", "{$controller}@filter")->name("{$uri}.filter");
            Route::resource($uri, $controller);
            Route::delete("{$uri}/{{$singular}}/permanently", "{$controller}@destroyPermanently")->name("{$uri}.destroy_permanently");
            Route::post("{$uri}/{{$singular}}/restore", "{$controller}@restore")->name("{$uri}.restore");
        });
        Route::macro('dependentCrudRoutes', function ($uri, $controller) {
            $parts = explode("/", $uri);
            $result = $parts[0];
            Route::get("{$uri}/export", "{$controller}@export")->name("{$result}.export");
            Route::post("{$uri}/import", "{$controller}@import")->name("{$result}.import");
            $singular = Str::of($result)->singular();
            Route::put("{$uri}/updateStatus/{{$singular}}", "{$controller}@updateStatus")->name("{$result}.update_status");
            Route::post("{$uri}/filter", "{$controller}@filter")->name("{$result}.filter");
            Route::get("{$uri}", "{$controller}@index")->name("{$result}.index");
            Route::get("{$uri}/create", "{$controller}@create")->name("{$result}.create");
            Route::post("{$uri}", "{$controller}@store")->name("{$result}.store");
            Route::get("{$uri}/{{$singular}}", "{$controller}@show")->name("{$result}.show");
            Route::get("{$uri}/{{$singular}}/edit", "{$controller}@edit")->name("{$result}.edit");
            Route::put("{$uri}/{{$singular}}", "{$controller}@update")->name("{$result}.update");
            Route::delete("{$uri}/{{$singular}}", "{$controller}@destroy")->name("{$result}.destroy");
            Route::delete("{$uri}/{{$singular}}/permanently", "{$controller}@destroyPermanently")->name("{$result}.destroy_permanently");
            Route::post("{$uri}/{{$singular}}/restore", "{$controller}@restore")->name("{$result}.restore");
        });

        Route::macro('apiCrudRoutes', function ($uri, $controller) {
            Route::get("{$uri}/export", "{$controller}@export")->name("{$uri}.export");
            Route::post("{$uri}/import", "{$controller}@import")->name("{$uri}.import");
            $singular = Str::of($uri)->singular();
            Route::put("{$uri}/updateStatus/{{$singular}}", "{$controller}@updateStatus")->name("{$uri}.update_status");
            Route::post("{$uri}/filter", "{$controller}@filter")->name("{$uri}.filter");
            Route::apiResource($uri, $controller);
            Route::delete("{$uri}/{{$singular}}/permanently", "{$controller}@destroyPermanently")->name("{$uri}.destroy_permanently");
            Route::post("{$uri}/{{$singular}}/restore", "{$controller}@restore")->name("{$uri}.restore");
        });
    }
}
