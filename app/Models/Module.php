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
}