<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Property;

class ResidentialUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'building',
        'type',
        'area',
        'rate',
        'status',
        'property_id',
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
