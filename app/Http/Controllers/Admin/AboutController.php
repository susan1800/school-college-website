<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class AboutController extends BaseController
{

    public function index(){

        $this->setPageTitle('About Us', 'About Us');
        $targetAbout = About::first();
        return view('admin.abouts.index', compact('targetAbout'));
    }



    public function create(){

        $this->setPageTitle('About Us', 'Create About');
        return view('admin.abouts.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'details' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png',
        ]);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'about',
                $uploadedFile,
                $filename
            );

            $collection['image'] = 'about/'.$filename;

            $about = new About($collection);


            $about->save();

            return $this->responseRedirect('admin.abouts.index', 'about added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating about.', 'error', true, true);
        }

        // if (!$about) {
        //     return $this->responseRedirectBack('Error occurred while creating about.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetAbout = About::find($id);
            $this->setPageTitle('About Us', 'Edit About');
            return view('admin.abouts.edit', compact('targetAbout'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'phone' => 'required',
            'email' =>'required',
            'details' =>  'required|not_in:0',
            'location' =>'required',
            'map' => 'required',
            'image'     =>  'mimes:jpg,jpeg,png',

        ]);

        $collection = $request->except('_token');

        try {

            $about = About::find($request->id);



            if($request->file()){
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'about',
                $uploadedFile,
                $filename
            );
            $collection['image'] = 'about/'.$filename;
            $filePath = 'public/'.$about['image'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);
            // unlink($filePath);
            Storage::delete($filePath);
        }
        else{
                $collection['image'] =$about->image;
        }




            $about['email'] = $collection['email'];
            $about['phone'] = $collection['phone'];
            $about['location'] = $collection['location'];
            $about['map'] = $collection['map'];

            $about['details'] = $collection['details'];
            $about['image'] = $collection['image'];
            $about['facebook'] = $collection['facebook'];
            $about['youtube'] = $collection['youtube'];
            $about['linkedin'] = $collection['linkedin'];
            $about['instagram'] = $collection['instagram'];
            $about['twitter'] = $collection['twitter'];

            $about->save();

            return $this->responseRedirect('admin.abouts.index','Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {

            return $this->responseRedirectBack('Error occurred while updating about.', 'error', true, true);
        }

    }
    public function disable($id){
        try{
        $About = About::find($id);
        if($About['status']=='1'){
            $About['status']='0';
        }
        else{
            $About['status']='1';
        }

        $About->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status About.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $About = About::find($id);
            $About->delete();



    } catch (QueryException $exception) {
        return "error";
    }

    }
}
