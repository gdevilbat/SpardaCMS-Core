<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingControllerTest extends TestCase
{
	use RefreshDatabase, \Gdevilbat\SpardaCMS\Modules\Core\Tests\ManualRegisterProvider;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateSetting()
    {
    	$response = $this->get(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@create'));

        $response->assertStatus(302)
        		 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); // Return Not Valid, User Not Login

	    $user = \App\Models\User::find(1);

	    $response = $this->actingAs($user)
        				 ->from(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@create'))
        				 ->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@store'))
        				 ->assertStatus(405); //invalid token not set

	    $response = $this->actingAs($user)
        				 ->from(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@create'))
        				 ->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@store'), [
								'_method' => 'PUT'
        				 	])
        				 ->assertStatus(302)
        				 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@create'))
        				 ->assertSessionHas('global_message.status', 200)
        				 ->assertSessionHasNoErrors(); //Return Valid, Data Complete
    }
}
