<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeeStructure;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class FeeStructureController extends BaseController
{
    public function index(){
        $feestructures = FeeStructure::get();
        $this->setPageTitle('feestructure', 'feestructure');
        return view('admin.feestructures.index', compact('feestructures'));
    }



    public function create(){
       ;
        $this->setPageTitle('feestructure', 'Create feestructure');
        return view('admin.feestructures.create' );
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'science'      =>  'required',
            'management'      =>  'required',
            'humanities' =>'required',
            'bbs' => 'required',

        ]);
        // dd($request);

        $collection = $request->except('_token');

        try {

            $feestructure = new Feestructure($collection);

            $feestructure->save();

            return $this->responseRedirect('admin.feestructures.index', 'feestructure added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            dd($exception);
            return $this->responseRedirectBack('Error occurred while creating feestructure.', 'error', true, true);
        }


    }
    public function edit($id){
        try {
            $targetfeestructure = FeeStructure::find($id);
            $this->setPageTitle('feestructure', 'Edit feestructure');
            return view('admin.feestructures.edit', compact('targetfeestructure'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){
        // dd($request);

        $this->validate($request, [
            'title'      =>  'required',
            'science'      =>  'required',
            'management'      =>  'required',
            'humanities' =>'required',
            'bbs'   =>   'required',
        ]);

        $collection = $request->except('_token');

        try {


            $feestructure = FeeStructure::find($request->id);

            $feestructure['title'] = $collection['title'];
            $feestructure['science'] = $collection['science'];
            $feestructure['management'] = $collection['management'];
            $feestructure['humanities'] = $collection['humanities'];
            $feestructure['bbs'] = $collection['bbs'];
            $feestructure['remarks'] = $collection['remarks'];
            $feestructure->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating feestructure.', 'error', true, true);
        }

    }


    public function disable($id){
        try{
        $feestructure = FeeStructure::find($id);
        if($feestructure['status']=='1'){
            $feestructure['status']='0';
        }
        else{
            $feestructure['status']='1';
        }
        $feestructure->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status feestructure.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $feestructure = FeeStructure::find($id);

            $feestructure->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }
}
