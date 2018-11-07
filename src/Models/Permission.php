<?php

namespace Jervenclark\Roles\Models;

use Jervenclark\Slugs\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use Sluggable;

    /**
     * Name of the field to use for generating slugs
     *
     * @var string
     */
    protected static $sluggable = 'name';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Permission roles
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
