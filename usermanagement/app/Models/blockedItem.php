<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class blockedItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "blockeditems";

    protected $primaryKey = "id";

    protected $fillable = [
        'type',
        'value',
        'note',
        'user_id',
    ];

}
