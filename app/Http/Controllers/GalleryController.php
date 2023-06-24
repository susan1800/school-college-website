<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        $galleries = Gallery::where('status',1)->get();

        return view('gallery',compact('about','courses','galleries'));
    }

    public function singleGallery($id){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        $gallery = Gallery::find($id);

        return view('singlegallery',compact('about','courses','gallery'));
    }
}
