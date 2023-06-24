<?php

namespace App\Http\Controllers\Admin;

use App\Models\HostelFee;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
class HostelFeeController extends BaseController
{
    public function index(){
        $hostelfees = HostelFee::get();
        $this->setPageTitle('hostelfee', 'hostelfee');
        return view('admin.hostelfees.index', compact('hostelfees'));
    }



    public function create(){
       ;
        $this->setPageTitle('hostelfee', 'Create hostelfee');
        return view('admin.hostelfees.create' );
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'amount'      =>  'required',

        ]);
        // dd($request);

        $collection = $request->except('_token');

        try {

            $hostelfee = new hostelfee($collection);

            $hostelfee->save();

            return $this->responseRedirect('admin.hostelfees.index', 'hostelfee added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            dd($exception);
            return $this->responseRedirectBack('Error occurred while creating hostelfee.', 'error', true, true);
        }


    }
    public function edit($id){
        try {
            $targethostelfee = HostelFee::find($id);
            $this->setPageTitle('hostelfee', 'Edit hostelfee');
            return view('admin.hostelfees.edit', compact('targethostelfee'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){
        // dd($request);

        $this->validate($request, [
            'title'      =>  'required',
            'amount'      =>  'required',

        ]);

        $collection = $request->except('_token');

        try {


            $hostelfee = HostelFee::find($request->id);

            $hostelfee['title'] = $collection['title'];
            $hostelfee['amount'] = $collection['amount'];
            $hostelfee['remarks'] = $collection['remarks'];
            $hostelfee->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating hostelfee.', 'error', true, true);
        }

    }


    public function disable($id){
        try{
        $hostelfee = HostelFee::find($id);
        if($hostelfee['status']=='1'){
            $hostelfee['status']='0';
        }
        else{
            $hostelfee['status']='1';
        }
        $hostelfee->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status hostelfee.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $hostelfee = HostelFee::find($id);

            $hostelfee->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }
}
