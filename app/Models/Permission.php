<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'is_active'];
    
    /**
     * Define the relationship between permission and module.
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'permissions_module', 'permission_id', 'module_code')->withTimestamps();
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_permission');
    }
}