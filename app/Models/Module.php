<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $primaryKey = 'code'; // Specify the primary key column

    protected $keyType = 'string';
    protected $fillable = ['code', 'name', 'description', 'parent_module_code', 'is_active'];

    public function subModules()
    {
        return $this->hasMany(Module::class, 'parent_module_code', 'code');
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permissions_module')->withPivot(['create', 'edit', 'view', 'delete']);
    }
    // public function parentModule()
    // {
    //     return $this->belongsTo(Module::class, 'parent_module_code');
    // }
}