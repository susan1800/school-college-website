<?php

namespace App\Http\Controllers\Admin;

use App\Models\FAQ;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class FAQController extends BaseController
{

    public function index(){
        $faqs = FAQ::get();
        $this->setPageTitle('FAQ', 'FAQ');
        return view('admin.faqs.index', compact('faqs'));
    }



    public function create(){

        $this->setPageTitle('FAQ', 'Create FAQ');
        return view('admin.faqs.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'title' =>  'required|not_in:0',
            'details'     =>  'required|not_in:0',
        ]);

        $collection = $request->except('_token');

        try {

            $faq = new FAQ($collection);


            $faq->save();

            return $this->responseRedirect('admin.faqs.index', 'FAQ added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating FAQ.', 'error', true, true);
        }

        // if (!$faq) {
        //     return $this->responseRedirectBack('Error occurred while creating faq.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetfaq = FAQ::find($id);
            $this->setPageTitle('FAQ Us', 'Edit FAQ : '.$targetfaq->name);
            return view('admin.faqs.edit', compact('targetfaq'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [

            'title' =>  'required|not_in:0',
            'details'     =>  'required|not_in:0',

        ]);

        $collection = $request->except('_token');

        try {

            $faq = FAQ::find($request->id);
            $faq['status'] = '1';
            $faq['title'] = $collection['title'];
            $faq['details'] = $collection['details'];
            $faq->save();

            return $this->responseRedirect('admin.faqs.index','Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating about.', 'error', true, true);
        }

    }
    public function disable($id){
        try{
        $faq = FAQ::find($id);
        if($faq['status']=='1'){
            $faq['status']='0';
        }
        else{
            $faq['status']='1';
        }

        $faq->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status FAQ.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $faq = FAQ::find($id);

            $faq->delete();
            return "success";

    } catch (QueryException $exception) {
        return "error";
    }

    }
}
