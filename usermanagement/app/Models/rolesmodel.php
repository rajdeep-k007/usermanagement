<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rolesmodel extends Model
{
    use HasFactory;

    public function roles(){
        return $this->hasMany(User::class);
    }
}
