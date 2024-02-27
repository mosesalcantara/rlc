<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\ResidentialUnit;

class Snapshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'residential_unit_id'
    ];

    public function residential_unit(): BelongsTo
    {
        return $this->belongsTo(ResidentialUnit::class);
    }
}
