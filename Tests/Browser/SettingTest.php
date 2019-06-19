<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SettingTest extends DuskTestCase
{
    use DatabaseMigrations, \Gdevilbat\SpardaCMS\Modules\Core\Tests\ManualRegisterProvider;
    
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testEditSetting()
    {
        $user = \App\User::find(1);

        $this->browse(function (Browser $browser) use ($user) {
            $faker = \Faker\Factory::create();

            $browser->loginAs($user)
                    ->visit(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@create'))
                    ->assertSee('Setting Form')
                    ->type('global[meta_title]', $faker->word)
                    ->type('global[meta_description]', $faker->text)
                    ->type('global[fb_share_title]', $faker->word)
                    ->type('global[fb_share_image]', $faker->word)
                    ->type('global[background][landscape]', $faker->word)
                    ->type('global[background][portrait]', $faker->word)
                    ->type('global[favicon]', $faker->word)
                    ->type('global[logo]', $faker->word)
                    ->type('global[maintenance_image]', $faker->word)
                    ->type('global[google_site_verification]', $faker->uuid)
                    ->type('global[meta_script]', $faker->text)
                    ->type('pagination_count', 1)
                    ->press('Submit')
                    ->waitForText('Setting Form')
                    ->assertSee('Success To Update Setting');
        });
    }
}
