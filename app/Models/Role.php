<?php

namespace App\Models;

// use App\Http\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'is_active'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}