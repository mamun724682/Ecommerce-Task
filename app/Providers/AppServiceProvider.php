<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Response macro's
        Response::macro('success', function ($message, $data = [], $status_code = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data'    => $data,
            ], $status_code);
        });

        Response::macro('error', function ($message, $data = [], $status_code = 400) {
            return response()->json([
                'error'   => true,
                'message' => $message,
                'data'    => $data,
            ], $status_code);
        });
    }
}
