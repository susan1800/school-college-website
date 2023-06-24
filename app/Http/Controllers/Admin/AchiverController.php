<?php

namespace App\Http\Controllers\Admin;

use App\Models\Achiever;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class AchiverController extends BaseController
{
    public function index(){
        $achievers = Achiever::latest()->get();
        $this->setPageTitle('Achiever', 'Achiever');
        return view('admin.achievers.index', compact('achievers'));
    }



    public function create(){
        $this->setPageTitle('achiever ', 'Create achiever');
        return view('admin.achievers.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'name'      =>  'required',
            'achievement' =>  'required|not_in:0',
            'image' => 'required|mimes:png,jpg,jpeg',


        ]);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'achiever/',
                $uploadedFile,
                $filename
            );


            $collection['image'] = 'achiever/'.$filename;

            $achiever = new Achiever($collection);


            $achiever->save();

            return $this->responseRedirect('admin.achievers.index', 'achiever added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating achiever.', 'error', true, true);
        }

        // if (!$achiever) {
        //     return $this->responseRedirectBack('Error occurred while creating achiever.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetachievers = Achiever::find($id);
            $this->setPageTitle('achiever', 'Edit achiever ');
            return view('admin.achievers.edit', compact('targetachievers'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'name'      =>  'required',
            'achievement' =>  'required',
            'image' => 'mimes:png,jpg,jpeg',
        ]);

        $collection = $request->except('_token');

        try {


            $achiever = Achiever::find($request->id);


            if($request->file()){


            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'achiever/',
                $uploadedFile,
                $filename
            );
            $filePath = 'public/'.$achiever['image'];

            $collection['image'] = 'achiever/'.$filename;
        }
        else{
                $collection['image'] =$achiever->image;
        }


            $achiever['name'] = $collection['name'];
            $achiever['image'] = $collection['image'];
            $achiever['achievement'] = $collection['achievement'];


            $achiever->save();
        if($request->file('image')){
            Storage::delete($filePath);
        }

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating achiever.', 'error', true, true);
        }

        // if (!$achiever) {
        //     return $this->responseRedirectBack('Error occurred while creating achiever.', 'error', true, true);
        // }



    }



    public function disable($id){
        try{
        $achiever = Achiever::find($id);
        if($achiever['status']=='1'){
            $achiever['status']='0';
        }
        else{
            $achiever['status']='1';
        }

        $achiever->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status achiever.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $achiever = Achiever::find($id);

            $achiever->delete();
            return "success";

    } catch (QueryException $exception) {
        return "error";
    }

    }
}
