<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
