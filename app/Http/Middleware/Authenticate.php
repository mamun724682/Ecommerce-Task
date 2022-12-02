<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->is('api/*') || $request->is('oauth/*')) {
            throw new \Exception('Unauthorized request.', Response::HTTP_UNAUTHORIZED);
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
