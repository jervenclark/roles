<?php

namespace Jervenclark\Roles\Models;

use Jervenclark\Roles\Models\Permission;
use Jervenclark\Slugs\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
    protected $fillable = ['name', 'description', 'level'];

    /**
     * Role permissions
     *
     * @return void
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
