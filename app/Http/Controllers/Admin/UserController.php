<?php

namespace App\Http\Controllers\Admin;

use App\Models\Board;
use App\Models\Category;
use App\Models\User;
use App\Models\MetaKeyword;
use App\Models\About;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use Mail;
class UserController extends BaseController
{

    public function index(){
        $users = User::get();
        $this->setPageTitle('user', 'user');
        $metakeyword = MetaKeyword::first();
        return view('admin.users.index', compact('users' , 'metakeyword'));
    }



    public function signup(){
        $boards = Board::distinct()->where('status' , '=' , '1')->get('title');
        $metakeyword = MetaKeyword::first();
        $about =About::where('status' , '=' , '1')->latest()->first();
        return view('frontend_new.signup' , compact('boards' , 'metakeyword','about'));
    }
    public function signin(){
        $boards = Board::distinct()->where('status' , '=' , '1')->get('title');
        $metakeyword = MetaKeyword::first();
        $about =About::where('status' , '=' , '1')->latest()->first();
        return view('frontend_new.signin' , compact('boards' , 'metakeyword','about'));
    }




    public function register(Request $request){
        $this->validate($request, [
            'name'      =>  'required',
            'email'      =>  'required',
            'password'      =>  'required',

        ]);

        try {


            $users = user::where('email', $request->email)->get();

            # check if email is more than 1
            if(sizeof($users) > 0){
                # tell user not to duplicate same email
                // $msg = 'This user already signed up !';
                return $this->responseRedirect('signin', ' This user already signed up !' ,'success',false, false);
            }

            $namechar = str_split($request->name);

            $input = $request->all();

            foreach(range('a','z') as $v){
                if($v == $namechar['1']){
                    $upper = strtoupper($namechar['1']);
                    $input['image'] = 'profilepic/default/'.$upper.'.png';
                }
            }
            // exit();


            $input['password'] = bcrypt($request->password);
            $input['author_id']='1';

            $user = user::create($input);
            // $otp=mt_rand(100000, 999999);


            // $mail['otpcode'] = $otp;
            // \Mail::to($request->email)->send(new \App\Mail\mailotp($details));

            // $email=$request['email'];

            // return view('mail.checkotp' , compact('otp','email' , 'details'));
            // return view('mail.checkotp' , compact('otp' , 'email'));

            return $this->responseRedirect('signin', ' sucessfully signup !!  Please login' ,'success',false, false);




            // $namechar = str_split($request->name);



            // foreach(range('a','z') as $v){
            //     if($v == $namechar['1']){
            //         $upper = strtoupper($namechar['1']);
            //         $collection['image'] = 'profilepic/default/'.$upper.'.png';
            //     }
            // }

            // $collection['author_id'] = '1';
        //   echo $collection['image'];
        //   exit();
            // $user = new User($collection);

            // $user->save();

            // return $this->responseRedirect('signin', ' Register successfully Please login !!!' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while Register Please try again !!.', 'error', true, true);
        }

        // if (!$blog) {
        //     return $this->responseRedirectBack('Error occurred while creating Blog.', 'error', true, true);
        // }


    }


    public function login(Request $request){
        $users = user::where('email', $request->email)->get();

        # check if email is more than 1
        if(sizeof($users) < 1){
            # tell user not to duplicate same email
            // $msg = 'This user already signed up !';
            return $this->responseRedirectBack('Account not found ! please signup first or use different email.', 'error', true, true);
        }
    }





    public function edit($id){
        try {
            $categories = Category::get();
            $users =er::where('verified','=','1')->where('status','=','1')->get();
            $targetBlog = Blog::find($id);
            $metakeyword = MetaKeyword::first();
            $this->setPageTitle('blog', 'Edit Blog : '.$targetBlog->name);

            return view('admin.users.edit', compact('targetBlog' , 'categories' , 'users' , 'metakeyword'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
            'subtitle'      =>  'required',
            'user_id'      =>  'required',
            'category_id'      =>  'required',
            'about_author' =>'required',
            'details' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png',

        ]);

        $collection = $request->except('_token');

        try {

            $user = User::find($request->id);



            if($request->file()){
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'profilepic/'.$user->id,
                $uploadedFile,
                $filename
            );
            $collection['image'] = 'profilepic/'.$user->id.'/'.$filename;



        }
        else{
                $collection['image'] =$blog->image;
        }






            $blog['title'] = $collection['title'];
            $blog['subtitle'] = $collection['subtitle'];
            $blog['category_id'] = $collection['category_id'];
            $blog['user_id'] = $collection['user_id'];
            $blog['details'] = $collection['details'];
            $blog['about_author'] = $collection['about_author'];
            $blog['image'] = $collection['image'];
            $blog->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating Blog.', 'error', true, true);
        }

        // if (!$blog) {
        //     return $this->responseRedirectBack('Error occurred while creating Blog.', 'error', true, true);
        // }



    }
    public function delete($id){
        $blog = Blog::find($id);
        $blog['status']='0';
        $blog->save();
        return $this->responseRedirectBack('delete sucessfully.', 'sucess', false, false);

    }


}
