<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class BlogController extends BaseController
{

    public function index(){
        $blogs = Blog::get();
        $this->setPageTitle('blog', 'blog');
        return view('admin.blogs.index', compact('blogs'));
    }



    public function create(){
        $categories = Category::where('status' , 1)->get();
        $users =User::where('verified','=','1')->where('status','=','1')->get();
        $this->setPageTitle('blog', 'Create Blog');
        return view('admin.blogs.create' , compact('categories' , 'users'));
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'user_id'      =>  'required',
            'category_id'      =>  'required',
            'about_author' =>'required',
            'details' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png',

        ]);
        // dd($request);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'blog',
                $uploadedFile,
                $filename
            );


            $collection['image'] = 'blog/'.$filename;
            $blog = new Blog($collection);


            $blog->save();

            return $this->responseRedirect('admin.blogs.index', 'blog added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating Blog.', 'error', true, true);
        }


    }
    public function edit($id){
        try {
            $categories = Category::where('status' , 1)->get();
            $users =User::where('verified','=','1')->where('status','=','1')->get();
            $targetBlog = Blog::find($id);
            $this->setPageTitle('blog', 'Edit Blog : '.$targetBlog->name);
            return view('admin.blogs.edit', compact('targetBlog' , 'categories' , 'users'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){
        // dd($request);

        $this->validate($request, [
            'title'      =>  'required',
            'user_id'      =>  'required',
            'category_id'      =>  'required',
            'about_author' =>'required',
            'details' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png',

        ]);

        $collection = $request->except('_token');

        try {


            $blog = Blog::find($request->id);



            if($request->file()){
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'blog',
                $uploadedFile,
                $filename
            );
            $collection['image'] = 'blog/'.$filename;
            $filePath = 'public/'.$blog['image'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);
            // unlink($filePath);
            Storage::delete($filePath);
        }
        else{
                $collection['image'] =$blog->image;
        }






            $blog['title'] = $collection['title'];
            $blog['category_id'] = $collection['category_id'];
            $blog['user_id'] = $collection['user_id'];
            $blog['details'] = $collection['details'];
            $blog['about_author'] = $collection['about_author'];
            $blog['image'] = $collection['image'];
            $blog['status'] = '1';
            $blog->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating Blog.', 'error', true, true);
        }

    }


    public function disable($id){
        try{
        $Blog = Blog::find($id);
        if($Blog['status']=='1'){
            $Blog['status']='0';
        }
        else{
            $Blog['status']='1';
        }
        $Blog->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Blog.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Blog = Blog::find($id);

            $Blog->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }

}
