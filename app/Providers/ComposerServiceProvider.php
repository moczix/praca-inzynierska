<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(['guest/index'], 'App\Http\Composers\HeaderComposer');//tam sie uruchamia ten boot

        // Using Closure based composers...
        View::composer('*', function()
        {

        });
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

}