<?php

namespace App\Http\Controllers\Admin;

use App\Models\Scholarship;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class ScholarshipController extends BaseController
{

    public function index(){
        $scholarships = Scholarship::get();
        $this->setPageTitle('scholarship', 'scholarship');
        return view('admin.scholarships.index', compact('scholarships'));
    }



    public function create(){
       ;
        $this->setPageTitle('scholarship', 'Create scholarship');
        return view('admin.scholarships.create' );
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'quota'      =>  'required',
            'waive'      =>  'required',
            'eligibility' =>'required',

        ]);
        // dd($request);

        $collection = $request->except('_token');

        try {

            $scholarship = new Scholarship($collection);
            // dd($scholarship);


            $scholarship->save();

            return $this->responseRedirect('admin.scholarships.index', 'scholarship added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating scholarship.', 'error', true, true);
        }


    }
    public function edit($id){
        try {
            $targetScholarship = Scholarship::find($id);
            $this->setPageTitle('scholarship', 'Edit scholarship');
            return view('admin.scholarships.edit', compact('targetScholarship'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){
        // dd($request);

        $this->validate($request, [
            'title'      =>  'required',
            'quota'      =>  'required',
            'waive'      =>  'required',
            'eligibility' =>'required',


        ]);

        $collection = $request->except('_token');

        try {


            $scholarship = Scholarship::find($request->id);

            $scholarship['title'] = $collection['title'];
            $scholarship['waive'] = $collection['waive'];
            $scholarship['eligibility'] = $collection['eligibility'];
            $scholarship['quota'] = $collection['quota'];
            $scholarship['remarks'] = $collection['remarks'];
            $scholarship->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating scholarship.', 'error', true, true);
        }

    }


    public function disable($id){
        try{
        $scholarship = Scholarship::find($id);
        if($scholarship['status']=='1'){
            $scholarship['status']='0';
        }
        else{
            $scholarship['status']='1';
        }
        $scholarship->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status scholarship.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $scholarship = Scholarship::find($id);

            $scholarship->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }

}
