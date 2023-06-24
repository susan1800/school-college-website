<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\Achiever;

class AchivementController extends Controller
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        $achievers = Achiever::where('status',1)->get();

        return view('achievers',compact('about','courses','achievers'));
    }
}
