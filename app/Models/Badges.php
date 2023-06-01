<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $table = 'badges';
    protected $fillable = ['id', 'name', 'badge', 'is_active'];
}
