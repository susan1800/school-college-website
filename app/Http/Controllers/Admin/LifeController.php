<?php

namespace App\Http\Controllers\Admin;

use App\Models\Life;
use App\Models\Program;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class LifeController extends BaseController
{
    public function index(){
        $lifes = Life::get();
        $this->setPageTitle('Slideshow', 'Slideshow');
        return view('admin.lifes.index', compact('lifes'));
    }



    public function create(){
        $this->setPageTitle('Life at advance', 'Create Life at Advance');
        return view('admin.lifes.create');
    }




    public function store(Request $request){
        // dd($request->file('$request->image')->getMimeType());
        $this->validate($request, [
            'image'     =>  'required',
        ]);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'life',
                $uploadedFile,
                $filename
            );

            $collection['image'] = 'life/'.$filename;
            $slideshow = new Life($collection);


            $slideshow->save();

            return $this->responseRedirect('admin.lifes.index', 'slideshow added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating slideshow.', 'error', true, true);
        }

        // if (!$slideshow) {
        //     return $this->responseRedirectBack('Error occurred while creating slideshow.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetlife = Life::find($id);
            $this->setPageTitle('Life', 'Edit Life at advance : '.$targetlife->name);
            return view('admin.lifes.edit', compact('targetlife'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){


        $collection = $request->except('_token');

        try {

            $slideshow = Life::find($request->id);

            if($request->file()){
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'slideshow',
                $uploadedFile,
                $filename
            );
            $filePath = 'public/'.$slideshow['image'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);

            $collection['image'] = 'slideshow/'.$filename;
        }
        else{
                $collection['image'] =$slideshow->image;
        }


            $slideshow['image'] = $collection['image'];
            $slideshow['status'] = '1';

            $slideshow->save();
            if($request->file()){
                // unlink($filePath);
                Storage::delete($filePath);
            }

            return $this->responseRedirect('admin.lifes.index','Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating slideshow.', 'error', true, true);
        }

        // if (!$slideshow) {
        //     return $this->responseRedirectBack('Error occurred while creating slideshow.', 'error', true, true);
        // }



    }








    public function disable($id){
        try{
        $SlideShow = Life::find($id);
        if($SlideShow['status']=='1'){
            $SlideShow['status']='0';
        }
        else{
            $SlideShow['status']='1';
        }
        $SlideShow->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status SlideShow.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $SlideShow = Life::find($id);
            $SlideShow->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }

}
