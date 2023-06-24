<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class NoticeController extends BaseController
{
    public function index(){
        $notices = Notice::get();
        $this->setPageTitle('Notice', 'Notice');
        return view('admin.notices.index', compact('notices'));
    }



    public function create(){
        $this->setPageTitle('Notice ', 'Create notice');
        return view('admin.notices.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'file' => 'required',


        ]);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('file');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'notice/',
                $uploadedFile,
                $filename
            );


            $collection['file'] = 'notice/'.$filename;




            $notice = new Notice($collection);


            $notice->save();

            return $this->responseRedirect('admin.notices.index', 'notice added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating notice.', 'error', true, true);
        }

        // if (!$notice) {
        //     return $this->responseRedirectBack('Error occurred while creating notice.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetnotice = Notice::find($id);
            $this->setPageTitle('Notice', 'Edit notice');
            return view('admin.notices.edit', compact('targetnotice'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
        ]);

        $collection = $request->except('_token');

        try {


            $notice = Notice::find($request->id);


            if($request->file()){


            $filename = null;
            $uploadedFile = $request->file('file');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'notice/',
                $uploadedFile,
                $filename
            );
            $filePath = 'public/'.$notice['file'];

            $collection['file'] = 'notice/'.$filename;
        }
        else{
                $collection['file'] =$notice->file;
        }


            $notice['title'] = $collection['title'];
            $notice['file'] = $collection['file'];


            $notice->save();
        if($request->file('file')){
            Storage::delete($filePath);
        }

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
        $notice = Notice::find($id);
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

        $notice = Notice::find($id);
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
