<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Subject;
use App\Models\Program;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class CommentController extends BaseController
{
    public function index(){
        $comments = Comment::latest()->get();
        $this->setPageTitle('Comment', 'Comment');
        return view('admin.comments.index', compact('comments'));
    }








    public function store(Request $request){
        $this->validate($request, [
            'comment'      =>  'required',
            'blog_id' =>  'required|int',
            'name' =>  'required',
            'email' =>  'required|email',


        ]);

        $collection = $request->except('_token');

        try {

            $comment = new Comment($collection);


            $comment->save();

            return $this->responseRedirectBack('Comment added sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating comment.', 'error', true, true);
        }

    }
    public function edit($id){
        try {
            $subjects =Subject::get();
            $programs =Program::get();
            $targetComment = Comment::find($id);
            $this->setPageTitle('Comment Us', 'Edit Comment : '.$targetComment->name);
            return view('admin.comments.edit', compact('targetComment' , 'subjects' , 'programs'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'comment'      =>  'required',
            'subject_id' =>  'required|int',
            'hours' =>  'required|int',



        ]);

        $collection = $request->except('_token');

        try {

            $comment = Comment::find($request->id);




            $comment['comment'] = $collection['comment'];
            $comment['subject_id'] = $collection['subject_id'];
            $comment['hours'] = $collection['hours'];
            $comment['status'] = '1';

            $comment->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating comment.', 'error', true, true);
        }

        // if (!$comment) {
        //     return $this->responseRedirectBack('Error occurred while creating comment.', 'error', true, true);
        // }



    }




    public function disable($id){
        try{
        $Comment = Comment::find($id);
        if($Comment['status']=='1'){
            $Comment['status']='0';
        }
        else{
            $Comment['status']='1';
        }
        $Comment->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Comment.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Comment = Comment::find($id);
            $Comment->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }

}
