<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Tests;

use Mockery;
use Illuminate\Contracts\Foundation\Application;

trait ManualRegisterProvider{

    protected $seed;

    public function setUp():void
    {
        parent::setUp();
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

    /**
     * @before
     */
    public function setupSeed()
    {
        $self = $this;
        $this->afterApplicationCreated(function () use ($self) {
            $self->artisan('module:sparda-seed');
        });
    }
}