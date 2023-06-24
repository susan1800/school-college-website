<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use App\Models\Subject;
use App\Models\Program;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class LevelController extends BaseController
{
    public function index(){
        $levels = Level::get();
        $this->setPageTitle('Level', 'Level');
        return view('admin.levels.index', compact('levels'));
    }



    public function create(){
        $programs = Program::where('status' , 1)->get();
        $this->setPageTitle('Level ', 'Create Level');
        return view('admin.levels.create' , compact( 'programs'));
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'program_id' =>  'required|int',


        ]);

        $collection = $request->except('_token');

        try {

            $level = new Level($collection);


            $level->save();

            return $this->responseRedirect('admin.levels.index', 'Level added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating Level.', 'error', true, true);
        }




    }
    public function edit($id){
        try {
            $programs =Program::where('status' , 1)->get();
            $targetLevel = Level::find($id);
            $this->setPageTitle('Level', 'Edit Level : '.$targetLevel->name);
            return view('admin.levels.edit', compact('targetLevel' , 'programs'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
            'program_id' =>  'required|int',



        ]);

        $collection = $request->except('_token');

        try {

            $level = Level::find($request->id);




            $level['title'] = $collection['title'];
            $level['program_id'] = $collection['program_id'];
            $level['status'] = '1';

            $level->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating .', 'error', true, true);
        }





    }


    public function disable($id){
        try{
        $level = Level::find($id);
        if($level['status']=='1'){
            $level['status']='0';
        }
        else{
            $level['status']='1';
        }

        $level->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status level.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $level = Level::find($id);
        if(count($level->subject) == 0){
            $level->delete();
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
