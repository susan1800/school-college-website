<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\Form;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use Mail;

class AdmissionFormController extends BaseController
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();

        return view('admission',compact('about','courses'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',

            'course' =>  'required',
            'gender' =>'required',
            'birthday' => 'required',
            'nationality' =>  'required',
            'mobile' =>'required|digits:10',
            'father_name' => 'required',
            'father_number' => 'required|digits:10',
            'image'     =>  'required|mimes:jpg,jpeg,png',
        ]);

        $collection = $request->except('_token');

        try {

            if($request->course == "science" || $request->course == "management" || $request->course == "humanities"){
                $this->validate($request, [

                    'see_grade' =>'required',
                    'school_name' => 'required',
                ]);
            }

            if($request->course == "bbs"){
                $this->validate($request, [

                    'see_grade' =>'required',
                    'school_name' => 'required',
                    'neb_grade' =>'required',
                    'neb_school_name' => 'required',
                ]);
            }

            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'admissionform',
                $uploadedFile,
                $filename
            );

            $collection['image'] = 'admissionform/'.$filename;

            $admission = new Form($collection);
            $admission['name'] = $collection['name'];
            $admission['email'] = $collection['email'];
            $admission['see_grade'] = $collection['see_grade'];
            $admission['course'] = $collection['course'];
            $admission['gender'] = $collection['gender'];
            $admission['birthday'] = $collection['birthday'];
            $admission['nationality'] = $collection['nationality'];
            $admission['mobile'] = $collection['mobile'];
            $admission['father_name'] = $collection['father_name'];
            $admission['father_number'] = $collection['father_number'];
            $admission['school_name'] = $collection['school_name'];
            $admission['image'] = $collection['image'];
            $admission['query'] = $collection['query'];
            $admission->save();
            // dd($collection);
            // $details[];
            // $details = $collection;
            \Mail::to('dcadhikari08@gmail.com')->send(new \App\Mail\Admission($collection));

            return $this->responseRedirect('admission', 'The form has been submitted successfully! We will contact you shortly.' ,'success',false, false);

        } catch (QueryException $exception) {
            // dd($exception);
            return $this->responseRedirectBack('An error occurred while submitting the form. Please try again.', 'error', true, true);
        }


        // dd($collection);

    }
}
