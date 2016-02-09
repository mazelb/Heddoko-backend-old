<?php
/**
 * Copyright Heddoko(TM) 2016, all rights reserved.
 *
 * @brief   Combines OAuth2 with Laravel's authentication service, using one or the other.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    February 2016
 */
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;

class AppAuthenticationProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        parent::boot($events);

        $events->listen('router.matched', [$this, 'applyMiddleware']);
    }

    /**
     * Inspects the request and sets the proper middleware accordingly.
     *
     * @param \Illuminate\Routing\Route $route
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function applyMiddleware($route, $request)
    {
        // Define some middleware for API routes.
        if ($route->getPrefix() == 'api/v1')
        {
            // Authenticate through OAuth2.
            if ($request->headers->has('Authorization') || $request->has('access_token')) {
                $route->middleware(\LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware::class);
            }

            // Authenticate through Laravel.
            else {
                $route->middleware(\App\Http\Middleware\Authenticate::class);
            }
        }
    }
}
