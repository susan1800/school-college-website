<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fact;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class FactController extends BaseController
{

    public function index(){
        $facts = Fact::get();
        $this->setPageTitle('facts', 'facts');
        return view('admin.facts.index', compact('facts'));
    }



    public function create(){

        $this->setPageTitle('facts', 'Create facts');
        return view('admin.facts.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'name'      =>  'required',

        ]);

        $collection = $request->except('_token');

        try {

            $fact = new Fact($collection);


            $fact->save();

            return $this->responseRedirect('admin.facts.index', 'fact added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating fact.', 'error', true, true);
        }

        // if (!$fact) {
        //     return $this->responseRedirectBack('Error occurred while creating fact.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {

            $targetFact = Fact::find($id);
            $this->setPageTitle('Fact', 'Edit Fact : '.$targetFact->name);
            return view('admin.facts.edit', compact('targetFact'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
            'name'      =>  'required',

        ]);

        $collection = $request->except('_token');

        try {

            $fact = Fact::find($request->id);

            $fact['title'] = $collection['title'];
            $fact['name'] = $collection['name'];
            $fact['status'] = '1';
            $fact->save();

            return $this->responseRedirect('admin.facts.index','Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating fact.', 'error', true, true);
        }

        // if (!$fact) {
        //     return $this->responseRedirectBack('Error occurred while creating fact.', 'error', true, true);
        // }



    }







    public function disable($id){
        try{
        $Fact = Fact::find($id);
        if($Fact['status']=='1'){
            $Fact['status']='0';
        }
        else{
            $Fact['status']='1';
        }
        $Fact->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Fact.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Fact = Fact::find($id);
            $Fact->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }



}
