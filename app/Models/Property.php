<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\ResidentialUnit;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'name',
        'location',
        'description',
    ];

    public function residential_units(): HasMany
    {
        return $this->hasMany(ResidentialUnit::class);
    }
}
