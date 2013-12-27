<?php namespace Nijibelle\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider {

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
		$this->package('nijibelle/users');

		// Bring the application container instance into the local scope so we can
		// import it into the filters scope.
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		
		include __DIR__.'/../../routes.php';

		$this->app['users'] = $this->app->share(function($app)
		{
		    return new Users($app['view'], $app['config'], $app['url']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('users');
	}

}
