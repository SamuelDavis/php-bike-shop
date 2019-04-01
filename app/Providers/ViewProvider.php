<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ViewProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share("mainNav", [
            ["/", "Events"],
            ["/people", "People"],
            ["/bikes", "Bikes"],
        ]);
    }
}
