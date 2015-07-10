<?php

class SiteTest extends TestCase {

	public function testAuthRedirects()
	{
		$response = $this->call('GET', '/');

		$this->assertEquals(302, $response->getStatusCode());
	}

	public function testProfile()
	{
		$user = factory('App\User')->create();

    $this->actingAs($user)
         ->visit('/me')
         ->see($user->name);
	}

	public function testHome()
	{
		$user = factory('App\User')->create();

    $this->actingAs($user)
         ->visit('/')
         ->see($user->points);

    $this->actingAs($user)
         ->visit('/')
				->click(trans('app.buy_points'))
         ->see($user->points);
	}

}
