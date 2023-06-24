<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class GalleryController extends BaseController
{
    public function index(){
        $galleries = Gallery::get();
        $this->setPageTitle('Gallery', 'Gallery');
        return view('admin.galleries.index', compact('galleries'));
    }



    public function create(){
        $this->setPageTitle('Gallery ', 'Create Gallery');
        return view('admin.galleries.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'location' =>  'required',
            'image' => 'mimes:png,jpg,jpeg',
            'date'  => 'required',
        ]);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'gallery/',
                $uploadedFile,
                $filename
            );


            $collection['image'] = 'gallery/'.$filename;




            $gallery = new Gallery($collection);
            // dd($gallery);


            $gallery->save();

            return $this->responseRedirect('admin.galleries.index', 'Gallery added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating Gallery.', 'error', true, true);
        }

        // if (!$notice) {
        //     return $this->responseRedirectBack('Error occurred while creating notice.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetgallery = Gallery::find($id);
            $this->setPageTitle('Gallery', 'Edit Gallery');
            return view('admin.galleries.edit', compact('targetgallery'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
            'location' =>  'required',
            'image' => 'mimes:png,jpg,jpeg',
            'date'  => 'required',
        ]);

        $collection = $request->except('_token');

        try {


            $gallery = Gallery::find($request->id);
            if($request->file()){
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'gallery/',
                $uploadedFile,
                $filename
            );
            $filePath = 'public/'.$gallery['image'];

            $collection['image'] = 'gallery/'.$filename;
        }
        else{
                $collection['image'] =$gallery->image;
        }


            $gallery['title'] = $collection['title'];
            $gallery['location'] = $collection['location'];
            $gallery['date'] = $collection['date'];
            $gallery['image'] = $collection['image'];


            $gallery->save();


            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating notice.', 'error', true, true);
        }

        // if (!$notice) {
        //     return $this->responseRedirectBack('Error occurred while creating notice.', 'error', true, true);
        // }



    }



    public function disable($id){
        try{
        $notice = Gallery::find($id);
        if($notice['status']=='1'){
            $notice['status']='0';
        }
        else{
            $notice['status']='1';
        }

        $notice->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status notice.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $notice = Gallery::find($id);
        if(count($notice->subject) == 0 && count($notice->level) == 0 ){
            $notice->delete();
            return "success";
        }
        else{
            return "reletion error";
        }


    } catch (QueryException $exception) {
        return "error";
    }

    }
}
