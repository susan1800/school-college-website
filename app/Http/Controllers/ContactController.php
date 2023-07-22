<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\ContactMessage;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use App\Models\Contact;

class ContactController extends BaseController
{
    public function index(){
        $about = About::first();
        $courses = Course::where('status',1)->get();

        return view('contactus',compact('about','courses'));
    }
    public function store(Request $request){


        $this->validate($request, [
            'name' => 'required',
            'email' =>'required|email',
            'phone' =>  'required|digits:10',
            'message' =>'required',
        ]);

        $collection = $request->except('_token');

        try {
            $admission = new ContactMessage($collection);

            $admission->save();
            \Mail::to('timalsinasusan14@gmail.com')->send(new \App\Mail\Contact($collection));

            return $this->responseRedirect('contact', 'The form has been submitted successfully! We will contact you shortly.' ,'success',false, false);

        } catch (QueryException $exception) {
            // dd($exception);
            return $this->responseRedirectBack('An error occurred while submitting the form. Please try again.', 'error', true, true);
        }

    }
}
