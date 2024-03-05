<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading_title',
        'heading_image',
        'description',
        'tagline_title',
        'tagline',
        'video_code',
        'video_title',
        'video_description',
    ];
}
