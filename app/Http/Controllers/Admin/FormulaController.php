<?php

namespace App\Http\Controllers\Admin;

use App\Models\Formula;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;


class FormulaController extends BaseController
{
    public function index(){
        $formulas = Formula::get();
        $this->setPageTitle('Formula', 'Formula');
        return view('admin.formulas.index', compact('formulas'));
    }



    public function create(){
        $this->setPageTitle('Formula ', 'Create Formula');
        return view('admin.formulas.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'formula'      =>  'required',
            'pdf' =>  'required|mimes:pdf',
            'image' => 'required|mimes:png,jpg,jpeg',


        ]);

        $collection = $request->except('_token');

        try {

            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'formula/',
                $uploadedFile,
                $filename
            );


            $collection['image'] = 'formula/'.$filename;




            $filename = null;
            $uploadedFile = $request->file('pdf');
            $filename = $uploadedFile->getClientOriginalName().time(). $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'formula/',
                $uploadedFile,
                $filename
            );


            $collection['pdf'] = 'formula/'.$filename;


            $formula = new Formula($collection);
           $formula['image'] =$collection['image'];
           $formula['pdf'] =$collection['pdf'];
        //    dd($formula);

            $formula->save();

            return $this->responseRedirect('admin.formulas.index', 'formula added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating formula.', 'error', true, true);
        }

        // if (!$formula) {
        //     return $this->responseRedirectBack('Error occurred while creating formula.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetFormula = Formula::find($id);
            $this->setPageTitle('formula', 'Edit formula : '.$targetFormula->name);
            return view('admin.formulas.edit', compact('targetFormula'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'formula'      =>  'required',
            'pdf' =>  'mimes:pdf',
            'image' => 'mimes:png,jpg,jpeg',


        ]);

        $collection = $request->except('_token');

        try {

            $formula = Formula::find($request->id);

            if($request->file()){

                if($request->file('image')){
                $filename = null;
                $uploadedFile = $request->file('image');
                $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

                Storage::disk('public')->putFileAs(
                    'formula/',
                    $uploadedFile,
                    $filename
                );
                $filePath = 'public/storage/'.$formula['image'];
                // unlink('/storage/app/public/fileupload/'.$blog['name']);
                // unlink($filePath);
                Storage::delete($filePath);
                $collection['image'] = 'formula/'.$filename;
            }else{
                $collection['image'] =$formula->image;
            }




            if($request->file('pdf')){
                $filename = null;
                $uploadedFile = $request->file('pdf');

                $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME).time().'.'. $uploadedFile->getClientOriginalExtension();

                Storage::disk('public')->putFileAs(
                    'formula/',
                    $uploadedFile,
                    $filename
                );
                $filePath = 'public/'.$formula['pdf'];
                // unlink('/storage/app/public/fileupload/'.$blog['name']);
                // unlink($filePath);
                $collection['pdf'] = 'formula/'.$filename;
            }
            else{
                $collection['pdf'] =$formula->pdf;
            }
            }
            else{
                    $collection['image'] =$formula->image;
                    $collection['pdf'] =$formula->pdf;
            }


            $formula['formula'] = $collection['formula'];
            $formula['image'] = $collection['image'];
            $formula['pdf'] = $collection['pdf'];
            $formula['status'] = '1';

            $formula->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating formula.', 'error', true, true);
        }

        // if (!$formula) {
        //     return $this->responseRedirectBack('Error occurred while creating formula.', 'error', true, true);
        // }



    }






    public function disable($id){
        try{
        $Formula = Formula::find($id);
        if($Formula['status']=='1'){
            $Formula['status']='0';
        }
        else{
            $Formula['status']='1';
        }
        $Formula->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Formula.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Formula = Formula::find($id);
            $Formula->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }
}
