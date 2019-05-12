<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App;
use Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsToMany("\Gdevilbat\SpardaCMS\Modules\Role\Entities\Role", "role_users", "user_id", "role_id");
    }

    public function userAccount()
    {
        return $this->hasOne("\Gdevilbat\SpardaCMS\Modules\Account\Entities\UserAccount", "user_id");
    }

    public function hasAccess( $permission, $user, $module_slug, $modules)
    {
        if(empty($module_slug))
            return false;

        $module = $modules->where('slug', $module_slug)->first();
        if(empty($module))
          abort(404, 'Module Not Exist');

        $id_module = $module->id;

        $role = $this->with(['role.modules' => function($query) use ($id_module) {
                    $query->where('module.id', $id_module);
                }])->where('id', $user->id)->first();

        try {
            if($role->role->first()->slug == 'super-admin')
                return true;
        } catch (\Exception $e) {
            if(!App::environment('production'))
            {
                throw new \Gdevilbat\SpardaCMS\Modules\Core\Exceptions\ManualHandler($e);
            }
            else
            {
                Log::info($e->getMessage());
            }
        }

        try {
            return json_decode(json_decode($role->role->first()->modules->first()->pivot->access_scope)->$permission) ? true : false;
        } catch (\Exception $e) {
            if(!App::environment('production'))
            {
                throw new \Gdevilbat\SpardaCMS\Modules\Core\Exceptions\ManualHandler($e);
            }
            else
            {
                Log::info($e->getMessage());
            }
        }

        return false;
    }
}
