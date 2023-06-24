<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table = "abouts";
    protected $fillable = [
        'details',
        'facebook',
        'linkedin',
        'youtube',
        'twitter',
        'instagram',
        'pinterest',
        'email',
        'phone',
        'location',
        'map',
        'image',
    ];
}
