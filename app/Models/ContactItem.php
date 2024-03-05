<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading_title',
        'heading_image',
        'title',
        'subtitle',
        'email',
    ];
}
