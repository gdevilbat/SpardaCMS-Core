<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $table = 'setting';
    protected $casts = [
        'value' => 'array',
    ];
}
