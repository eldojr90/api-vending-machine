<?php

namespace App\Providers;

use App\Cartao;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {
            $token = $request->input('api_token');

            if($request->isMethod('post')) {
                $token = $request->bearerToken();
            }


            if ($token) {
                return Cartao::where('api_token', $token)->first();
            }
        });
    }

}