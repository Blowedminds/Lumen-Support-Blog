<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapEditorRoutes();

        $this->mapReaderRoutes();

        $this->mapImageRoutes();

        $this->mapDiscussRoutes();

        $this->mapAuthRoutes();

        $this->mapUserRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapEditorRoutes()
    {
        Route::prefix('editor')
             ->middleware('api')
             ->namespace($this->namespace . "\Editor")
             ->group(base_path('routes/editor.php'));
    }

    protected function mapReaderRoutes()
    {
        Route::prefix('reader')
             ->middleware('api')
             ->namespace($this->namespace . "\Reader")
             ->group(base_path('routes/reader.php'));
    }

    protected function mapImageRoutes()
    {
        Route::prefix('image')
             ->middleware('api')
             ->namespace($this->namespace . "\Image")
             ->group(base_path('routes/image.php'));
    }
    protected function mapDiscussRoutes()
    {
        Route::prefix('discuss')
             ->middleware('api')
             ->namespace($this->namespace . "\Discuss")
             ->group(base_path('routes/discuss.php'));
    }

    protected function mapAuthRoutes()
    {
        Route::prefix('auth')
            ->middleware('api')
            ->namespace($this->namespace . "\Auth")
            ->group(base_path('routes/auth.php'));
    }
    protected function mapUserRoutes()
    {
        Route::prefix('user')
            ->middleware('api')
            ->namespace($this->namespace . "\User")
            ->group(base_path('routes/user.php'));
    }
}
