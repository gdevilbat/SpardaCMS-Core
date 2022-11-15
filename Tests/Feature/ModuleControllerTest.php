<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleControllerTest extends TestCase
{
	use RefreshDatabase, \Gdevilbat\SpardaCMS\Modules\Core\Tests\ManualRegisterProvider;

    public function testReadMaster()
    {
        $response = $this->get(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'));

        $response->assertStatus(302)
        		 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); // Return Not Valid, User Not Login

        $user = \App\Models\User::find(1);

        $response = $this->actingAs($user)
        				 ->get(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))
        				 ->assertSuccessful(); // Return Valid user Login
    }

    public function testFormCreateDataModule()
    {
    	$response = $this->get(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create'));

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); // Return Not Valid, User Not Login

        $user = \App\Models\User::find(1);

        $response = $this->actingAs($user)
        				 ->get(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create'))
        				 ->assertSuccessful(); // Return Valid user Login
    }

    public function testCreateDataModule()
    {
    	$response = $this->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@store'));

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); //Return Not Valid, User Not Login

        $user = \App\Models\User::find(1);

        $response = $this->actingAs($user)
        				 ->from(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create'))
        				 ->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@store'))
        				 ->assertStatus(302)
        				 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create'))
        				 ->assertSessionHasErrors(); //Return Not Valid, Data Not Complete

	    $faker = \Faker\Factory::create();
	    $slug = $faker->word;

		$response = $this->actingAs($user)
        				 ->from(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create'))
        				 ->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@store'), [
								'name' => $faker->word,
								'slug' => $slug,
                                'description' => $faker->text,
								'order' => 0,
        				 	])
        				 ->assertStatus(302)
        				 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))
        				 ->assertSessionHas('global_message.status', 200)
        				 ->assertSessionHasNoErrors(); //Return Valid, Data Complete

	 	$this->assertDatabaseHas(\Gdevilbat\SpardaCMS\Modules\Core\Entities\Module::getTableName(), ['slug' => $slug]);
    }

    public function testFormUpdateDataModule()
    {
    	$response = $this->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create'));

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); //Return Not Valid, User Not Login


        $user = \App\Models\User::find(1);
        $module = \Gdevilbat\SpardaCMS\Modules\Core\Entities\Module::latest()->first();

        $response = $this->actingAs($user)
				        ->get(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create').'?code='.encrypt($module->getKey()))
				        ->assertSuccessful();
    }

    public function testUpdateDataModule()
    {
    	$response = $this->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@store'), [
    					'_method' => 'PUT'
			    	]);

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); //Return Not Valid, User Not Login


        $user = \App\Models\User::find(1);
        $module = \Gdevilbat\SpardaCMS\Modules\Core\Entities\Module::latest()->first();

        $response = $this->actingAs($user)
				        ->from(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@create').'?code='.encrypt($module->getKey()))
				        ->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@store'), [
				        	$module->getKeyName() => encrypt($module->getKey()),
				        	'name' => $module->name,
				        	'slug' => $module->slug,
				        	'order' => $module->order,
							'_method' => 'PUT'
				    	])
				    	->assertStatus(302)
						->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))
						->assertSessionHas('global_message.status', 200)
						->assertSessionHasNoErrors(); //Return Valid, Data Complete
    }

    public function testDeleteDataModule()
    {
    	$response = $this->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@destroy'), [
    					'_method' => 'DELETE'
			    	]);

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); //Return Not Valid, User Not Login


        $user = \App\Models\User::find(1);
        $module = \Gdevilbat\SpardaCMS\Modules\Core\Entities\Module::where('slug', 'test')->first();

        $response = $this->actingAs($user)
				        ->from(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))
				        ->post(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@destroy'), [
				        	$module->getKeyName() => encrypt($module->getKey()),
							'_method' => 'DELETE'
				    	])
				    	->assertStatus(302)
						->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))
						->assertSessionHas('global_message.status', 200);
    }
}
