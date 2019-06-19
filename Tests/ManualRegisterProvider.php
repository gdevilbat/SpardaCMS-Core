<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Tests;

use Mockery;
use Illuminate\Contracts\Foundation\Application;

trait ManualRegisterProvider{

	public function setUp():void
	{
		parent::setUp();
		$this->artisan('module:seed');
		$authentication = new \Gdevilbat\SpardaCMS\Modules\Role\Providers\AuthServiceProvider(Mockery::mock(Application::class));
		$authentication->boot();
	}

}