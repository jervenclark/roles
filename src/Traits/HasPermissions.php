<?php

namespace Jervenclark\Roles\Traits;

use Jervenclark\Roles\Models\Permission;
use Jervenclark\Roles\Models\Role;

trait HasPermissions {

    /**
     * Get model roles
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get model permissions
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Check if model has role
     *
     * @return boolean
     */
    public function hasRole( ... $roles) {
        if (is_string($roles)) return $this->roles->contains('slug', $roles);
        if (is_array($roles[0])) $roles = $roles[0];
        $user_roles = $this->roles->pluck('slug')->toArray();
        return (bool) array_intersect($roles, $user_roles);
    }

    /**
     * Check if model has permission to execute action
     *
     * @return boolean
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * Check if model has permission
     *
     * @return boolean
     */
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->slug($permission)->count();
    }

    /**
     * Check if model belongs to role with permission
     *
     * @return boolean
     */
    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) return true;
        }
        return false;
    }
}
