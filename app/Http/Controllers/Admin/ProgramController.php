<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class ProgramController extends BaseController
{
    public function index(){
        $programs = Course::get();
        $this->setPageTitle('Program', 'Program');
        return view('admin.programs.index', compact('programs'));
    }



    public function create(){
        $this->setPageTitle('Program ', 'Create Program');
        return view('admin.programs.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'details' =>  'required|not_in:0',
            'image' => 'required|mimes:png,jpg,jpeg',


        ]);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'program/',
                $uploadedFile,
                $filename
            );


            $collection['image'] = 'program/'.$filename;




            $program = new Course($collection);


            $program->save();

            return $this->responseRedirect('admin.programs.index', 'program added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating program.', 'error', true, true);
        }

        // if (!$program) {
        //     return $this->responseRedirectBack('Error occurred while creating program.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetProgram = Course::find($id);
            $this->setPageTitle('Program Us', 'Edit Program : '.$targetProgram->name);
            return view('admin.programs.edit', compact('targetProgram'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
            'details' =>  'required',
            'image' => 'mimes:png,jpg,jpeg',
        ]);

        $collection = $request->except('_token');

        try {


            $program = Course::find($request->id);


            if($request->file()){


            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'program/',
                $uploadedFile,
                $filename
            );
            $filePath = 'public/'.$program['image'];

            $collection['image'] = 'program/'.$filename;
        }
        else{
                $collection['image'] =$program->image;
        }


            $program['title'] = $collection['title'];
            $program['image'] = $collection['image'];
            $program['details'] = $collection['details'];


            $program->save();
        if($request->file('image')){
            Storage::delete($filePath);
        }

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating program.', 'error', true, true);
        }

        // if (!$program) {
        //     return $this->responseRedirectBack('Error occurred while creating program.', 'error', true, true);
        // }



    }



    public function disable($id){
        try{
        $program = Course::find($id);
        if($program['status']=='1'){
            $program['status']='0';
        }
        else{
            $program['status']='1';
        }

        $program->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status program.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $program = Course::find($id);
        if(count($program->subject) == 0 && count($program->level) == 0 ){
            $program->delete();
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
