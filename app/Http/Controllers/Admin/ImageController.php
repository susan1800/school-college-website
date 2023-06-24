<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Gallery;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ImageController extends BaseController
{
    public function index(){
        $images = Gallery::get();
        // dd($images);
        $this->setPageTitle('Gallery images', 'Gallery images');
        return view('admin.images.index', compact('images'));
    }

    // ->distinct()
    // ->pluck('your_column')

    public function create(){
        $galleries = Gallery::get();
        $this->setPageTitle('Gallery ', 'Create Gallery images');
        return view('admin.images.create', compact('galleries'));
    }




    public function store(Request $request){
        $this->validate($request, [
            'images[]' => 'mimes:png,jpg,jpeg',
            'gallery_id'  => 'required',
        ]);

        $collection = $request->except('_token');

        try {


            $images = $request->file('images');
            DB::beginTransaction();
    foreach ($images as $image) {
        // $path = $image->store('uploads');

        $uploadedFile = $image;
        $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

        Storage::disk('public')->putFileAs(
            'images/',
            $uploadedFile,
            $filename
        );
        // dd($filename);
        $create = new Image();
        $create['image'] = $filename;
        $create['gallery_id'] = $request->gallery_id;
        $create->save();


        // Image::create(['path' => $path]); // replace Image with your model name
    }
    DB::commit();
    // return redirect()->back();


            return $this->responseRedirect('admin.images.index', 'images added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating images.', 'error', true, true);
        }

    }
    public function edit($id){
        try {
            $galleries = Gallery::get();
            $targetgallery = Gallery::find($id);
            $this->setPageTitle('Gallery Image', 'Edit Gallery image ');
            return view('admin.images.edit', compact('targetgallery','galleries'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'images[]' => 'mimes:png,jpg,jpeg',
            'gallery_id'  => 'required',
        ]);

        $collection = $request->except('_token');

        try {


            $images = $request->file('images');
            DB::beginTransaction();
    foreach ($images as $image) {
        // $path = $image->store('uploads');

        $uploadedFile = $image;
        $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

        Storage::disk('public')->putFileAs(
            'images/',
            $uploadedFile,
            $filename
        );
        // dd($filename);
        $create = new Image();
        $create['image'] = $filename;
        $create['gallery_id'] = $request->gallery_id;
        $create->save();


        // Image::create(['path' => $path]); // replace Image with your model name
    }
    DB::commit();
    // return redirect()->back();


    return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

} catch (QueryException $exception) {
    return $this->responseRedirectBack('Error occurred while updating notice.', 'error', true, true);
}






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

        $image = Image::find($id);

            $image->delete();
            return "success";




    } catch (QueryException $exception) {
        return "error";
    }

    }
}
