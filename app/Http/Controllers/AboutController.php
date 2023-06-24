<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;

class AboutController extends Controller
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        return view('aboutus',compact('about','courses'));
    }
}
