<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

use Str;
use Module as Module_core;
use Config;

class Module extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $table = 'module';
    protected $primaryKey = 'id_module';
    protected $casts = [
        'scope' => 'array',
    ];
    protected $appends = ['string_is_scanable'];

    const FOREIGN_KEY = 'module_id';

    /**
     * Set the user's Slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    /**
     * Set the get ScanableAttribute.
     *
     * @param  string  $value
     * @return void
     */
    public function getStringIsScanableAttribute()
    {
        if($this->is_scanable)
        {
            return 'Yes';
        }

        return 'No';
    }

    /**
     * Set the get ScanableAttribute.
     *
     * @param  string  $value
     * @return void
     */
    public function getModuleTypeAttribute()
    {
        if(!empty(Config::get('core_modules')))
        {
            $core_modules = Config::get('core_modules');
        }
        else
        {
            $core_modules = collect(Module_core::allEnabled())->keys();
            $core_modules = $core_modules->map(function($item, $key){
                              return \Str::slug($item);  
                            });

            Config::set(['core_modules' => $core_modules]);
        }

        if(in_array($this->slug, $core_modules->toArray()))
        {
            return 'Embed';
        }

        return 'Database';
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
