<?php

namespace App\Providers;

//OTHER'S NAMESPACES 
use Illuminate\Support\ServiceProvider;
//OBSERVERS
use App\Observers\UserObserver;
//MODELS
use App\Models\User;

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
        $user = new User;
        $user->observe(UserObserver::class);
    }
}
