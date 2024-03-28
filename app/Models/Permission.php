<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'is_active'];

    public function hasAccess($moduleCode, $action)
    {
        // Logic to check if the permission has access to the specified module and action
        // You need to implement this logic based on your application's requirements
        // For example, you might retrieve the module permissions from the pivot table and check if the action is allowed
        
        // Example implementation (assuming you have a pivot table named permissions_modules)
        return $this->modules()->where('module_code', $moduleCode)->exists();
    }
    
    /**
     * Define the relationship between permission and module.
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'permissions_module', 'permission_id', 'module_code')->withPivot(['create', 'edit', 'view', 'delete']);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_permission');
    }
    
}