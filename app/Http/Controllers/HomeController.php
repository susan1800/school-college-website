<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\About;
use App\Models\Event;
use App\Models\Notice;
use App\Models\Achiever;
use App\Models\Life;
use App\Models\Course;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::where('status',1)->get();
        $about = About::first();
        $events = Event::where('status',1)->latest()->limit(3)->get();
        $notices = Notice::where('status',1)->latest()->limit(4)->get();
        $achievers = Achiever::where('status',1)->get();
        $lifes = Life::where('status',1)->latest()->limit(9)->get();
        $courses = Course::where('status',1)->get();
        return view('index',compact('sliders','about','events','notices','achievers','lifes','courses'));

    }
}
