<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        include(app_path().'/Helpers/themeHelper.php');
        include(app_path().'/Helpers/adminHelper.php');

        view()->composer('layouts.admin.sidebar', function ($view) {
            $menu = menu_admin_sidebar();
            $view->with('menu', $menu);
        });
    }
}
