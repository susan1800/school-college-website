<?php

namespace App\Http\Controllers\Admin;

use App\Models\MetaKeyword;
use App\Models\Chapter;
use App\Models\Program;
use App\Models\Board;
use App\Models\Subject;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;


class MetaKeyWordController extends BaseController
{
    public function index(){
        $metakeywords = MetaKeyword::get();
        $this->setPageTitle('metakeywords', 'metakeywords');
        return view('admin.metakeywords.index', compact('metakeywords'));
    }
    public function displaykey(){


        $subjects = Subject::get('subject');
        $chapters = Chapter::get('chapter');
        $programs = Program::get('program');
        $boards = Board::get(['title' , 'subtitle']);
        return view('frontend.showkey' , compact('subjects','chapters','programs','boards'));
    }



    public function create(){

        $this->setPageTitle('metakeywords', 'Create metakeywords');
        return view('admin.metakeywords.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'keywords'      =>  'required',


        ]);

        $collection = $request->except('_token');

        try {

            $metakeyword = new MetaKeyword($collection);


            $metakeyword->save();

            return $this->responseRedirect('admin.metakeywords.index', 'metakeyword added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating fact.', 'error', true, true);
        }

        // if (!$metakeyword) {
        //     return $this->responseRedirectBack('Error occurred while creating fact.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {

            $targetMetaKeyword = MetaKeyword::find($id);
            $this->setPageTitle('MetaKeyword', 'Edit MetaKeyword ');
            return view('admin.metakeywords.edit', compact('targetMetaKeyword'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'keywords'      =>  'required',


        ]);

        $collection = $request->except('_token');

        try {

            $metakeyword = MetaKeyword::find($request->id);

            $metakeyword['keywords'] = $collection['keywords'];

            $metakeyword->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating fact.', 'error', true, true);
        }

        // if (!$fact) {
        //     return $this->responseRedirectBack('Error occurred while creating fact.', 'error', true, true);
        // }



    }
    public function delete($id){
        $metakeyword = MetaKeyword::find($id);
        $metakeyword['status']='0';
        $metakeyword->save();
        return $this->responseRedirectBack('delete sucessfully.', 'sucess', false, false);

    }
}
