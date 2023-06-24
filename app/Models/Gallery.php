<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = "galleries";
    protected $fillable = [
        'image',
        'title',
        'location',
        'date',
        'status',
    ];


    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
