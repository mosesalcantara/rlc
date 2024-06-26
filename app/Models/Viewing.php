<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'residential_unit_id',
        'date',
        'time',
        'message',
        'status',
    ];
}
