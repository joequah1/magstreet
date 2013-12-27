<?php namespace Nijibelle\Images;

use Illuminate\Support\ServiceProvider;

class ImagesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('nijibelle/images');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		include __DIR__.'/../../routes.php';

		$this->app['images'] = $this->app->share(function($app)
		{
		    return new Images($app['view'], $app['config'], $app['url']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('images');
	}

}