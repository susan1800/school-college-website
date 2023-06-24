<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();
        $notices = Notice::where('status',1)->paginate(9);

        return view('notice',compact('about','courses','notices'));
    }
}
