<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = "forms";
    protected $fillable = [
        'student_name',
        'course',
        'email',
        'grade',
        'school_name',
        'gender',
        'birthday',
        'nationality',
        'mobile_number',
        'photo',
        'certificate_photo',
        'father_name',
        'father_number',
        'query',
        'seen',
        'past_data',
    ];
}
