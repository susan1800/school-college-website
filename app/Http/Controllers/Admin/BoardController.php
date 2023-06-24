<?php

namespace App\Http\Controllers\Admin;

use App\Models\Board;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class BoardController extends BaseController
{
    public function index(){
        $boards = Board::get();
        $this->setPageTitle('Board', 'Board');
        return view('admin.boards.index', compact('boards'));
    }



    public function create(){

        $this->setPageTitle('Board ', 'Create Board');
        return view('admin.boards.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',



        ]);

        $collection = $request->except('_token');

        try {

            $board = new Board($collection);


            $board->save();

            return $this->responseRedirect('admin.boards.index', 'board added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating board.', 'error', true, true);
        }

        // if (!$board) {
        //     return $this->responseRedirectBack('Error occurred while creating board.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetBoard = Board::find($id);
            $this->setPageTitle('Board Us', 'Edit Board : '.$targetBoard->name);
            return view('admin.boards.edit', compact('targetBoard'));

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

            $board = Board::find($request->id);




            $board['title'] = $collection['title'];
            $board['subtitle'] = $collection['subtitle'];
            $board['status'] = '1';

            $board->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating board.', 'error', true, true);
        }

        // if (!$board) {
        //     return $this->responseRedirectBack('Error occurred while creating board.', 'error', true, true);
        // }



    }
    public function disable($id){
        try {

        $board = Board::find($id);
        if($board['status'] == 1){
            $board['status']='0';
        }
        else{
            $board['status']='1';
        }

        $board->save();
        return $this->responseRedirectBack('Status update sucessfully.', 'sucess', false, false);

    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating board.', 'error', true, true);
    }

    }
    public function delete($id){
        try{
            $board = Board::find($id);
            $board->delete();
            return $this->responseRedirectBack(' Delete sucessfully.', 'sucess', false, false);
        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating board.', 'error', true, true);
        }
    }
}
