<?php

namespace App\Http\Controllers\Admin;

use App\Models\Creator;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;


class CreatorController extends BaseController
{
    public function index(){
        $creators = Creator::get();
        $this->setPageTitle('Creator', 'Creator');
        return view('admin.creators.index', compact('creators'));
    }



    public function create(){

        $this->setPageTitle('Creator', 'Create Creator');
        return view('admin.creators.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'name'      =>  'required',
            // 'title'     =>  'required',
            'details'   =>  'required',
            'image'     =>  'mimes:jpg,jpeg,png',

        ]);

        $collection = $request->except('_token');


        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'creator',
                $uploadedFile,
                $filename
            );




            $collection['image'] = 'creator/'.$filename;
            $creator = new Creator($collection);
            $creator['title'] = $collection['title'];
            $creator['details'] = $collection['details'];
            $creator['instagram'] = $collection['instagram'];
        //    dd($creator);

            $creator->save();

            return $this->responseRedirect('admin.creators.index', 'creator added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating creator.', 'error', true, true);
        }

        // if (!$creator) {
        //     return $this->responseRedirectBack('Error occurred while creating creator.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetCreator = Creator::find($id);
            $this->setPageTitle('Creator', 'Edit Creator : '.$targetCreator->name);
            return view('admin.creators.edit', compact('targetCreator'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'name'      =>  'required',
            'details'   =>  'required',
            'image'     =>  'mimes:jpg,jpeg,png',

        ]);

        $collection = $request->except('_token');

        try {

            $creator = Creator::find($request->id);



            if($request->file()){
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'creator',
                $uploadedFile,
                $filename
            );
            $collection['image'] = 'creator/'.$filename;
            $filePath = 'public/'.$creator['image'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);
            // unlink($filePath);
            Storage::delete($filePath);
        }
        else{
                $collection['image'] =$creator->image;
        }






            $creator['name'] = $collection['name'];
            $creator['title'] = $collection['title'];
            $creator['facebook'] = $collection['facebook'];
            $creator['linkedin'] = $collection['linkedin'];
            $creator['github'] = $collection['github'];
            $creator['image'] = $collection['image'];
            $creator['instagram'] = $collection['instagram'];
            $creator['details'] = $collection['details'];
            $creator['status'] = '1';

            $creator->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating creator.', 'error', true, true);
        }

        // if (!$creator) {
        //     return $this->responseRedirectBack('Error occurred while creating creator.', 'error', true, true);
        // }



    }





    public function disable($id){
        try{
        $Creator = Creator::find($id);
        if($Creator['status']=='1'){
            $Creator['status']='0';
        }
        else{
            $Creator['status']='1';
        }
        $Creator->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Creator.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Creator = Creator::find($id);
            $Creator->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }


}
