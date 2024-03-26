<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'fullname',
        'email',
        'contact_number',
        'message',
    ];
}
