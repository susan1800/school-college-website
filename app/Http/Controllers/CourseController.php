<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;

class CourseController extends Controller
{
    public function index($id){
        $about = About::first();
        $targetcourse = Course::where('status',1)->find($id);
        $courses = Course::where('status',1)->get();
        return view('course',compact('about','targetcourse','courses'));
    }
}
