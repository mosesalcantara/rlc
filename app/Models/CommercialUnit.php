<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'retail_id',
        'size',
        'property_id',
        'building_id',
    ];
}
