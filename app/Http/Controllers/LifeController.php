<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\Life;

class LifeController extends Controller
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        $lifes = Life::where('status',1)->get();
        return view('life',compact('about','courses','lifes'));
    }
}
