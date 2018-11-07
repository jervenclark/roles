<?php

namespace Jervenclark\Roles\Traits;

use Jervenclark\Roles\Models\Permission;
use Jervenclark\Roles\Models\Role;

trait HasPermissions {

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasRole( ... $roles) {
        if (empty($roles)) return false;
        if (is_string($roles)) return $this->roles->contains('slug', $roles);
        if (is_array($roles[0])) $roles = $roles[0];
        $user_roles = $this->roles->pluck('slug')->toArray();
        return (bool) array_intersect($roles, $user_roles);
    }
}
