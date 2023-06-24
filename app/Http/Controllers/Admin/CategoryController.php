<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class CategoryController extends BaseController
{
    public function index(){
        $categories = Category::get();
        $this->setPageTitle('Category', 'Category');
        return view('admin.categories.index', compact('categories'));
    }



    public function create(){

        $this->setPageTitle('Category ', 'Create Category');
        return view('admin.categories.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'subtitle' =>  'required|not_in:0',


        ]);

        $collection = $request->except('_token');

        try {

            $category = new Category($collection);


            $category->save();

            return $this->responseRedirect('admin.categories.index', 'category added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }



    }
    public function edit($id){
        try {
            $targetCategory = Category::find($id);
            $this->setPageTitle('Category Us', 'Edit Category : '.$targetCategory->name);
            return view('admin.categories.edit', compact('targetCategory'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
            'subtitle' =>  'required|not_in:0',


        ]);

        $collection = $request->except('_token');

        try {

            $category = Category::find($request->id);




            $category['title'] = $collection['title'];
            $category['subtitle'] = $collection['subtitle'];
            $category['status'] = '1';

            $category->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        }

        // if (!$category) {
        //     return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        // }



    }






    public function disable($id){
        try{
        $Category = Category::find($id);
        if($Category['status']=='1'){
            $Category['status']='0';
        }
        else{
            $Category['status']='1';
        }
        $Category->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Category.', 'error', true, true);
    }

    }

    public function delete($id){

        try{

        $Category = Category::find($id);
        if(count($Category->blog) == 0){
            $Category->delete();
            return "success";
        }
        else{

            return "reletion error";
        }


    } catch (QueryException $exception) {
        return "error";
    }

    }


}
