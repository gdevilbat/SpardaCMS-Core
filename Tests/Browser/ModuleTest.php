<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ModuleTest extends DuskTestCase
{
    use DatabaseMigrations, \Gdevilbat\SpardaCMS\Modules\Core\Tests\ManualRegisterProvider;
    
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testCreateModule()
    {
        $user = \App\Models\User::find(1);
        $faker = \Faker\Factory::create();

        $this->browse(function (Browser $browser) use ($user, $faker) {
            $browser->loginAs($user)
                    ->visit(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))
                    ->assertSee('Master Data of Module')
                    ->clickLink('Add New Module')
                    ->waitForText('Module Form')
                    ->AssertSee('Module Form')
                    ->type('name', $faker->word)
                    ->type('slug', $faker->word)
                    ->type('order', 1)
                    ->type('description', $faker->text)
                    ->press('Submit')
                    ->waitForText('Master Data of Module')
                    ->assertSee('Successfully Add Module!');
        });
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testEditModule()
    {
        $user = \App\Models\User::find(1);

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                    ->visit(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))
                    ->assertSee('Master Data of Module')
                    ->clickLink('Action')
                    ->clickLink('Edit')
                    ->waitForText('Module Form')
                    ->AssertSee('Module Form')
                    ->press('Submit')
                    ->waitForText('Master Data of Module')
                    ->assertSee('Successfully Update Module!');
        });
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testDeleteModule()
    {
        $user = \App\Models\User::find(1);

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                    ->visit(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))
                    ->assertSee('Master Data of Module')
                    ->clickLink('Action')
                    ->clickLink('Delete')
                    ->waitForText('Delete Confirmation')
                    ->press('Delete')
                    ->waitForText('Successfully Delete Module!')
                    ->assertSee('Successfully Delete Module!');
        });
    }
}
