<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Models\Program;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class SlideShowController extends BaseController
{
    public function index(){
        $slideshows = Slider::get();
        $this->setPageTitle('Slideshow', 'Slideshow');
        return view('admin.slideshows.index', compact('slideshows'));
    }



    public function create(){
        $this->setPageTitle('Slideshow', 'Create Slideshow');
        return view('admin.slideshows.create');
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
                'slideshow',
                $uploadedFile,
                $filename
            );

            $collection['image'] = 'slideshow/'.$filename;
            $slideshow = new Slider($collection);


            $slideshow->save();

            return $this->responseRedirect('admin.slideshows.index', 'slideshow added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating slideshow.', 'error', true, true);
        }

        // if (!$slideshow) {
        //     return $this->responseRedirectBack('Error occurred while creating slideshow.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetSlideshow = Slider::find($id);
            $this->setPageTitle('Slideshow', 'Edit Slideshow : '.$targetSlideshow->name);
            return view('admin.slideshows.edit', compact('targetSlideshow'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){


        $collection = $request->except('_token');

        try {

            $slideshow = Slider::find($request->id);

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

            return $this->responseRedirect('admin.slideshows.index','Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating slideshow.', 'error', true, true);
        }

        // if (!$slideshow) {
        //     return $this->responseRedirectBack('Error occurred while creating slideshow.', 'error', true, true);
        // }



    }








    public function disable($id){
        try{
        $SlideShow = Slider::find($id);
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

        $SlideShow = Slider::find($id);
            $SlideShow->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }



}
