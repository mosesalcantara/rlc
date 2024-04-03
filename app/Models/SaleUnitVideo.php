<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleUnitVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'video',
        'residential_unit_id',
    ];
}
