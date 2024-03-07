<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Property;
use App\Models\Snapshot;

class ResidentialUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'type',
        'area',
        'rate',
        'status',
        'property_id',
        'building_id',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function snapshots(): HasMany
    {
        return $this->hasMany(Snapshot::class);
    }

}
