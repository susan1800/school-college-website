<?php

namespace App\Http\Controllers\Admin;

use App\Models\AllImage;
use App\Models\Gallery;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AllImageController extends BaseController
{
    public function index(){
        $images = AllImage::get();
        // dd($images);
        $this->setPageTitle('images', 'images');
        return view('admin.allimages.index', compact('images'));
    }

    // ->distinct()
    // ->pluck('your_column')

    public function create(){

        $this->setPageTitle('Image ', 'Create images');
        return view('admin.allimages.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'images[]' => 'mimes:png,jpg,jpeg',
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
            'allimages/',
            $uploadedFile,
            $filename
        );
        // dd($filename);
        $create = new AllImage();
        $create['image'] = 'allimages/'.$filename;
        $create->save();


        // Image::create(['path' => $path]); // replace Image with your model name
    }
    DB::commit();
    // return redirect()->back();


            return $this->responseRedirect('admin.allimages.index', 'images added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating images.', 'error', true, true);
        }

    }
    public function edit($id){
        try {

            $targetimages = AllImage::get();
            $this->setPageTitle('Image', 'Edit image ');
            return view('admin.allimages.edit', compact('targetimages'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'images[]' => 'mimes:png,jpg,jpeg',
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
            'allimages/',
            $uploadedFile,
            $filename
        );
        // dd($filename);
        $create = new AllImage();
        $create['image'] = 'allimages/'.$filename;
        $create->save();


        // Image::create(['path' => $path]); // replace Image with your model name
    }
    DB::commit();
    // return redirect()->back();


    return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

} catch (QueryException $exception) {
    return $this->responseRedirectBack('Error occurred while updating Image.', 'error', true, true);
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
        return $this->responseRedirectBack('Error occurred while updating status image.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $image = AllImage::find($id);

            $image->delete();
            return "success";




    } catch (QueryException $exception) {
        return "error";
    }

    }
}
