<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class activitylog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "logs";

    protected $primaryKey = "id";

    protected $fillable = [
        'user',
        'user_agent',
        'user_ip',
        'description',
        'route',
        'method',
    ];
}
