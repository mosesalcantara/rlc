<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'picture',
        'residential_unit_id',
    ];
}
