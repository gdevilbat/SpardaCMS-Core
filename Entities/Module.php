<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

use Str;

class Module extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $table = 'module';
    protected $casts = [
        'scope' => 'array',
    ];

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



}
