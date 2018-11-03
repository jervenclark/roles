<?php

namespace Jervenclark\Roles\Models;

use Jervenclark\Slugs\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Sluggable;

    protected static $sluggable = 'name';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'level'];

}
