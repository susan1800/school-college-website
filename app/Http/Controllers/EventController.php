<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\Event;

class EventController extends Controller
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        $events = Event::where('status',1)->paginate(9);

        return view('events',compact('about','courses','events'));
    }

    public function eventById($id){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        $event = Event::find($id);

        return view('event',compact('about','courses','event'));
    }
}
