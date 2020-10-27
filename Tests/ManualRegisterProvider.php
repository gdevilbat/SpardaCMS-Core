<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Tests;

use Mockery;
use Illuminate\Contracts\Foundation\Application;

trait ManualRegisterProvider{

	public function setUp():void
	{
		parent::setUp();
		$this->artisan('module:sparda-seed');
		$authentication = new \Gdevilbat\SpardaCMS\Modules\Role\Providers\AuthServiceProvider(Mockery::mock(Application::class));
		$authentication->boot();
	}

	public function tearDown():void
    {
        try {
            parent::tearDown();
        } catch (\BadMethodCallException $e) {
            if(!(env('DB_CONNECTION') == 'sqlite' && env('DB_DATABASE') != ':memory:'))
            {
                throw new \BadMethodCallException($e);
            }
        }
    }

}