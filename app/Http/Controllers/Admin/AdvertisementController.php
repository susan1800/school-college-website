<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertisement;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends BaseController
{
    public function index(){
        $advertisements = Advertisement::get();
        $this->setPageTitle('Advertisement', 'Advertisement');
        return view('admin.advertisements.index', compact('advertisements'));
    }



    public function create(){

        $this->setPageTitle('Advertisement', 'Create Advertisement');
        return view('admin.advertisements.create');
    }




    public function store(Request $request){
        $this->validate($request, [
            'title'      =>  'required',
            'details' =>  'required|not_in:0',
            'lat'     =>'required',
            'long'    => 'required',
            'image'     =>  'mimes:jpg,jpeg,png,gif',

        ]);

        $collection = $request->except('_token');

        try {
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'advertisement',
                $uploadedFile,
                $filename
            );




            $collection['image'] = 'advertisement/'.$filename;
            $advertisement = new Advertisement($collection);


            $advertisement->save();

            return $this->responseRedirect('admin.advertisements.index', 'advertisement added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating advertisement.', 'error', true, true);
        }

        // if (!$advertisement) {
        //     return $this->responseRedirectBack('Error occurred while creating advertisement.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $targetAdvertisement = Advertisement::find($id);
            $this->setPageTitle('Advertisement', 'Edit Advertisement : '.$targetAdvertisement->name);
            return view('admin.advertisements.edit', compact('targetAdvertisement'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
            'details' =>  'required|not_in:0',
            'lat'     =>'required',
            'long'     => 'required',
            'image'     =>  'mimes:jpg,jpeg,png',

        ]);

        $collection = $request->except('_token');

        try {

            $advertisement = Advertisement::find($request->id);



            if($request->file()){
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'advertisement',
                $uploadedFile,
                $filename
            );
            $collection['image'] = 'advertisement/'.$filename;
            $filePath = 'public/'.$advertisement['image'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);
            // unlink($filePath);
            Storage::delete($filePath);
        }
        else{
                $collection['image'] =$advertisement->image;
        }






            $advertisement['title'] = $collection['title'];
            $advertisement['details'] = $collection['details'];
            $advertisement['lat'] = $collection['lat'];
            $advertisement['long'] = $collection['long'];
            $advertisement['image'] = $collection['image'];
            $advertisement['status'] = '1';
            $advertisement->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating advertisement.', 'error', true, true);
        }

        // if (!$advertisement) {
        //     return $this->responseRedirectBack('Error occurred while creating advertisement.', 'error', true, true);
        // }



    }
    public function delete($id){
        $advertisement = Advertisement::find($id);
        $advertisement['status']='0';
        $advertisement->save();
        return $this->responseRedirectBack('delete sucessfully.', 'sucess', false, false);

    }
}
