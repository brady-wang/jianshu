<?php

namespace App\Providers;

use App\Lib\Tools\FooBar;
use Illuminate\Support\ServiceProvider;

class FooServiceProvider extends ServiceProvider
{

	protected $defer = false;
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
        $this->app->bind('foo',function(){
        	return new FooBar();
        });
    }

	public function provides()
	{
		return [FooBar::class];
	}
}
