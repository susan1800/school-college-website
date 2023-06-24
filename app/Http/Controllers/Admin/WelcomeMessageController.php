<?php

namespace App\Http\Controllers\Admin;

use App\Models\WelcomeMessage;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class WelcomeMessageController extends BaseController
{
    public function index(){
        $welcomes = WelcomeMessage::get();
        $this->setPageTitle('Welcome message', 'Welcome message');
        return view('admin.welcome_messages.index', compact('welcomes'));
    }



    public function create(){
        $this->setPageTitle('Welcome message ', 'Create Welcome message');
        return view('admin.welcome_messages.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'name'      =>  'required',
            'details' =>  'required',
            'image' => 'mimes:png,jpg,jpeg',
            'from'  => 'required',
        ]);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'welcome/',
                $uploadedFile,
                $filename
            );


            $collection['image'] = 'welcome/'.$filename;




            $welcome = new WelcomeMessage($collection);
            // dd($welcome);


            $welcome->save();

            return $this->responseRedirect('admin.welcomes.index', 'welcome message added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating welcome message.', 'error', true, true);
        }

        // if (!$notice) {
        //     return $this->responseRedirectBack('Error occurred while creating notice.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetWelcome = WelcomeMessage::find($id);
            $this->setPageTitle('Notice', 'Edit notice : '.$targetWelcome->name);
            return view('admin.welcome_messages.edit', compact('targetWelcome'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'name'      =>  'required',
            'details' =>  'required',
            'image' => 'mimes:png,jpg,jpeg',
            'from'  => 'required',
        ]);

        $collection = $request->except('_token');

        try {


            $welcome = WelcomeMessage::find($request->id);


            if($request->file()){


            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'welcome/',
                $uploadedFile,
                $filename
            );
            $filePath = 'public/'.$welcome['image'];

            $collection['image'] = 'welcome/'.$filename;
        }
        else{
                $collection['image'] =$welcome->image;
        }


            $welcome['name'] = $collection['name'];
            $welcome['details'] = $collection['details'];
            $welcome['from'] = $collection['from'];
            $welcome['image'] = $collection['image'];


            $welcome->save();


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
        $notice = WelcomeMessage::find($id);
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

        $notice = WelcomeMessage::find($id);
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
