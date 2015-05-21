<?php namespace App\Services;

use InvalidArgumentException;
use Illuminate\Support\Manager;

class SocialManager extends Manager {

	/**
	* Get a driver instance.
	*
	* @param  string  $driver
	* @return mixed
	*/
	public function with($driver)
	{
		return $this->driver($driver);
	}

	/**
	* Create an instance of the specified driver.
	*
	* @return App\Services\Social\AbstractProvider
	*/
	protected function createFacebookDriver()
	{
		$config = $this->app['config']['services.facebook'];
		return $this->buildProvider('App\Services\Social\FacebookProvider', $config);
	}

	/**
	* Create an instance of the specified driver.
	*
	* @return \App\Services\Social\AbstractProvider
	*/
	protected function createTwitterDriver()
	{
		$config = $this->app['config']['services.twitter'];
		return $this->buildProvider('App\Services\Social\TwitterProvider', $config);
	}
	
	/**
	* Create an instance of the specified driver.
	*
	* @return \App\Services\Social\AbstractProvider
	*/
	protected function createGoogleDriver()
	{
		$config = $this->app['config']['services.google'];
		return $this->buildProvider('App\Services\Social\GoogleProvider', $config);
	}

	/**
	* Build an OAuth 2 provider instance.
	*
	* @param  string  $provider
	* @param  array  $config
	* @return \App\Services\Social\AbstractProvider
	*/
	public function buildProvider($provider, $config)
	{
		return new $provider($this->app['request'], $config['client_id'], $config['client_secret']);
	}

	/**
	* Get the default driver name.
	*
	* @throws \InvalidArgumentException
	*
	* @return string
	*/
	public function getDefaultDriver()
	{
		throw new InvalidArgumentException('No driver was specified.');
	}
}