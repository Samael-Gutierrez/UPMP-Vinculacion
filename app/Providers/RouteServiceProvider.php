<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
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
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        Route::bind('admin', function ($value, $route) {
            return $this->getModel(\App\Models\Admin::class, $value);
        });

        Route::bind('area', function ($value, $route) {
            return $this->getModel(\App\Models\Area::class, $value);
        });

        Route::bind('asesorAcademico', function ($value, $route) {
            return $this->getModel(\App\Models\AsesorAcademico::class, $value);
        });

        Route::bind('asesorIndustrial', function ($value, $route) {
            return $this->getModel(\App\Models\AsesorIndustrial::class, $value);
        });

        Route::bind('carrera', function ($value, $route) {
            return $this->getModel(\App\Models\Carrera::class, $value);
        });

        Route::bind('cicloEscolar', function ($value, $route) {
            return $this->getModel(\App\Models\CicloEscolar::class, $value);
        });

        Route::bind('cuatrimestre', function ($value, $route) {
            return $this->getModel(\App\Models\Cuatrimestre::class, $value);
        });

        Route::bind('empresa', function ($value, $route) {
            return $this->getModel(\App\Models\Empresa::class, $value);
        });

        Route::bind('estudiante', function ($value, $route) {
            return $this->getModel(\App\Models\Estudiante::class, $value);
        });

        Route::bind('grupo', function ($value, $route) {
            return $this->getModel(\App\Models\Grupo::class, $value);
        });

        Route::bind('solicitud', function ($value, $route) {
            return $this->getModel(\App\Models\Solicitud::class, $value);
        });

        Route::bind('tipoDeUsuario', function ($value, $route) {
            return $this->getModel(\App\Models\TipoDeUsuario::class, $value);
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
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    private function getModel($model, $routeKey)
    {
        $id = \Hashids::connection($model)->decode($routeKey)[0] ?? null;
        $modelInstance = resolve($model);
        return $modelInstance->findOrFail($id);
    }
}
