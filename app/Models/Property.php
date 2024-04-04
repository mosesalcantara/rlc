<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Amenity;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'name',
        'location',
        'description',
        'sale_status',
        'min_price',
        'max_price',
        'unit_types',
    ];

    public function amenities(): HasMany
    {
        return $this->hasMany(Amenity::class);
    }
}
