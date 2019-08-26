<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use App\Firebase\Guard as FirebaseGuard;
// use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Auth::viaRequest('firebase', function ($request) {
        //     return app(FirebaseGuard::class)->user($request);
        // });
        $this->app['auth']->viaRequest('firebase', function ($request) {
            return app(\csrui\LaravelFirebaseAuth\Guard::class)->user($request);
        });
        //
    }
}
