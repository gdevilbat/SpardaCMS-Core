<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User as User_m;
use Illuminate\Notifications\Notifiable;

use App;
use Log;

class User extends User_m
{
    use Notifiable;

    const FOREIGN_KEY = 'user_id';

    protected $appends = [
        'primary_key',
        'encrypted_id',
    ];

    public function group()
    {
        return $this->hasOneThrough(
            \Gdevilbat\SpardaCMS\Modules\User\Entities\Group::class,
            \Gdevilbat\SpardaCMS\Modules\User\Entities\RltGroupUsers::class,
            SELF::FOREIGN_KEY,
            \Gdevilbat\SpardaCMS\Modules\User\Entities\Group::getPrimaryKey(),
            SELF::getPrimaryKey(),
            \Gdevilbat\SpardaCMS\Modules\User\Entities\Group::FOREIGN_KEY);
    }

    public function role()
    {
        return $this->hasOneThrough(
            "\Gdevilbat\SpardaCMS\Modules\Role\Entities\Role", 
            "\Gdevilbat\SpardaCMS\Modules\Role\Entities\RoleUser", 
            SELF::FOREIGN_KEY, 
            \Gdevilbat\SpardaCMS\Modules\Role\Entities\Role::getPrimaryKey(),
            SELF::getPrimaryKey(),
            \Gdevilbat\SpardaCMS\Modules\Role\Entities\Role::FOREIGN_KEY
        );
    }

    public function userAccount()
    {
        return $this->hasOne("\Gdevilbat\SpardaCMS\Modules\Account\Entities\UserAccount", SELF::FOREIGN_KEY);
    }

    public function userMeta()
    {
        return $this->hasMany(\Gdevilbat\SpardaCMS\Modules\User\Entities\UserMeta::class, SELF::FOREIGN_KEY);
    }

    final function getMetaAttribute()
    {
        $meta_repo = resolve(\Gdevilbat\SpardaCMS\Modules\User\Repositories\UserMetaRepository::class);
        $meta_repo->user = $this;

        return $meta_repo;
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

    public function getPrimaryKeyAttribute()
    {
        return $this->getPrimaryKey();
    }

    public function getEncryptedIdAttribute()
    {
        return encrypt($this->getKey());
    }

    public static function getTableName()
    {
        return with(new Static)->getTable();
    }

    public static function getPrimaryKey()
    {
        return with(new Static)->getKeyName();
    }

    public function getRateLimitAttribute($value)
    {
        if($value == 0)
            return 60;

        return $value;
    }
}
