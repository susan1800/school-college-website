<?php

namespace App\Http\Controllers\Admin;
use Hash;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class DashboardController extends BaseController
{
    public function index(){


        return view('admin.dashboard.index');
    }
    // public function update(Request $request){

    //     $this->validate($request, [
    //         'update'      =>  'required',
    //         'version'   =>  'required',
    //         'details'     =>  'required',

    //     ]);
    //     try{

    //         // dd(Hash::make("susan@password"));

    //     $update = UpdateApp::find(1);
    //     $update['update'] = $request->update;
    //     $update['version'] = $request->version;
    //     $update['details'] = $request->details;
    //     $update->save();

    //     if($update){

    //         return $this->responseRedirectBack('Successfully updated.', 'success', true, true);
    //     }
    //     else{
    //         return $this->responseRedirectBack('Error occurred while updating.', 'error', true, true);
    //     }
    // } catch (QueryException $exception) {
    //     return $this->responseRedirectBack('Error occurred while creating creator.', 'error', true, true);
    // }

    // }

    // public function application(Request $request){
    //     // $this->validate($request, [
    //     //     'version'   =>  'required',
    //     // ]);

    //     try{
    //         $update = Application::find(1);
    //         $update['version'] = $request->version;

    //         if($request->file()){
    //             $filename = null;
    //             $uploadedFile = $request->file('app');
    //             $filename = 'UttarPustika_'.$request->version.'.'. $uploadedFile->getClientOriginalExtension();

    //             Storage::disk('public')->putFileAs(
    //                 'application',
    //                 $uploadedFile,
    //                 $filename
    //             );
    //             $update['app'] = 'application/'.$filename;

    //         }
    //         else{
    //                 $update['app'] =$update->app;
    //         }
    //         $update->save();
    //         if($update){
    //             return $this->responseRedirectBack('Successfully updated.', 'success', true, true);

    //         }
    //         else{
    //             return $this->responseRedirectBack('Error occurred while updating.', 'error', true, true);
    //         }
    //     } catch (QueryException $exception) {
    //         return $this->responseRedirectBack('Error occurred while creating creator.', 'error', true, true);
    //     }


    // }
}
