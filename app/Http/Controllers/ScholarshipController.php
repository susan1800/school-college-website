<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\FeeStructure;
use App\Models\HostelFee;
use App\Models\Scholarship;

class ScholarshipController extends Controller
{
    public function index(){
        $about = About::first();
        $feestructures = FeeStructure::where('status',1)->get();
        $hostelfees = Hostelfee::where('status',1)->get();
        $scholarships = Scholarship::where('status',1)->get();
        $courses = Course::where('status',1)->get();
        return view('scholarship',compact('about','feestructures','hostelfees','scholarships','courses'));
    }
}
