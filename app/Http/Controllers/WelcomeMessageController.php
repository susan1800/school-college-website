<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\WelcomeMessage;

class WelcomeMessageController extends Controller
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        $principal = WelcomeMessage::where('status',1)->where('from','principal')->first();
        $viceprincipal = WelcomeMessage::where('status',1)->where('from','viceprincipal')->first();
        return view('welcomemessage',compact('about','courses','viceprincipal','principal'));
    }
}
