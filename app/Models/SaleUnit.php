<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'type',
        'price',
        'area',
        'property_id',
        'building_id',
    ];
}