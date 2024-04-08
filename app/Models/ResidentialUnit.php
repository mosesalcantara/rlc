<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentialUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'retail_status',
        'type',
        'area',
        'price',
        'status',
        'property_id',
        'building_id',
        'published',
    ];
}
