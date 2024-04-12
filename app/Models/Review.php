<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'fullname',
        'property_id',
        'reviewed_on',
        'review',
        'published',
    ];

    protected $casts = [
        'reviewed_on' => 'date',
    ];
}
