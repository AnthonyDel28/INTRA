<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'username', 'first_name', 'last_name', 'email', 'password',
        'level', 'experience', 'status', 'gender', 'image', 'role_id',
        'is_active'
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
