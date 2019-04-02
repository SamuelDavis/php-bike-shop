<?php

namespace App\Providers;

use App\Views\Components\MainNav;
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
        View::share("mainNav", new MainNav);
    }
}
