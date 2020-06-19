<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider; 
use App\Section;

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
        $sections = Section::all();
        view()->share('sections', $sections);
    }
}
