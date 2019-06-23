<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\User as User_m;

use App;
use Log;

class User extends User_m
{
    //use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function role()
    {
        return $this->belongsToMany("\Gdevilbat\SpardaCMS\Modules\Role\Entities\Role", "role_users", "user_id", "role_id");
    }

    public function userAccount()
    {
        return $this->hasOne("\Gdevilbat\SpardaCMS\Modules\Account\Entities\UserAccount", "user_id");
    }

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if(!empty($value))
        {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public static function getTableName()
    {
        return with(new Static)->getTable();
    }

    public static function getPrimaryKey()
    {
        return with(new Static)->getKeyName();
    }
}
