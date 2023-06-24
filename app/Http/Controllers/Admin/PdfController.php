<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Program;
use App\Models\Author;
use App\Models\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;
class PdfController extends BaseController
{

    public function deletepdf(){
        $pdfs = Pdf::get();
        $chapters = Chapter::get();

        foreach($pdfs as $pdf){
            $i=0;
            foreach($chapters as $chapter){
                if($chapter->id == $pdf->chapter_id){
                    $i=1;
                    continue;
                }

            }
            if($i==0){
                $Pdfdelete = Pdf::find($pdf->id);
                $Pdfdelete->delete();
                dd("delete");
            }
        }
        dd("not found");
    }
    public function index(){
        $pdfs = Pdf::latest()->get();
        $this->setPageTitle('Pdf', 'Pdf');
        return view('admin.pdfs.index', compact('pdfs'));
    }



    public function create(){
        $chapters = chapter::where('status',1)->get();
        $subjects = Subject::where('status',1)->get();
        $programs = Program::where('status',1)->get();
        $this->setPageTitle('Pdf', 'Create Pdf');
        return view('admin.pdfs.create' , compact('programs' , 'chapters' , 'subjects'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'hiddenid'      =>  'required',
        ]);

        $collection = $request->except('_token');

        try {
            DB::beginTransaction();

            for($i=0; $i<=$request->hiddenid;$i++){

            $this->validate($request, [
                'chapter_id'.$i =>  'required',
                'pdf'.$i => 'required',
            ]);

            $chapter = Chapter::find($request['chapter_id'.$i]);

            $filename = null;
            $uploadedFile = $request->file('pdf'.$i);
            $filename = $chapter->subject->subject.'_'.$chapter->subject->id.''.$chapter->id.'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'pdf/',
                $uploadedFile,
                $filename
            );
            $collection['pdf'] = $filename;
            $collection['chapter_id'] = $request['chapter_id'.$i];
            $pdf = new Pdf($collection);
            $pdf->save();
        }
        DB::commit();

            return $this->responseRedirect('admin.pdfs.index', 'pdf added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating pdf.', 'error', true, true);
        }

        // if (!$pdf) {
        //     return $this->responseRedirectBack('Error occurred while creating pdf.', 'error', true, true);
        // }


    }
    public function edit($id){
        try {
            $chapters = chapter::where('status' , 1)->get();
            $subjects = Subject::where('status' , 1)->get();
            $programs = Program::where('status' , 1)->get();
            $targetPdf = Pdf::find($id);

            $routename = Route::currentRouteName();
            if($routename == "admin.pdfs.getcopy"){
                $this->setPageTitle('Pdf', 'Copy Pdf : '.$targetPdf->name);
            }
            else{
                $this->setPageTitle('Pdf', 'Edit Pdf : '.$targetPdf->name);
            }


            return view('admin.pdfs.edit', compact('targetPdf' , 'programs' , 'subjects' , 'chapters'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function copy(Request $request){
        $this->validate($request, [
            'chapter_id' =>  'required',
            'id'=>'required',
        ]);
        try {
            $pdf = Pdf::find($request->id);
            $chapter = Chapter::find($request->chapter_id);

            $collection = new Pdf();
            $collection['pdf'] =$pdf->pdf;
            $collection['chapter_id'] =$request['chapter_id'];
            $collection['status'] = $pdf->status;

            $collection->save();
            return $this->responseRedirectBack('Copy sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while Copying pdf.', 'error', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'chapter_id' =>  'required',
            'author_id' => 'required',
            'pdf.'     =>  'mimes:pdf',

        ]);

        $collection = $request->except('_token');

        try {

            $pdf = Pdf::find($request->id);
            $chapter = Chapter::find($request->chapter_id);
            if($request->pdf){
            $filename = null;
            $uploadedFile = $request->file('pdf'.$i);
            $filename = $chapter->subject->subject.'_'.$chapter->subject->id.''.$chapter->id.'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'pdf/',
                $uploadedFile,
                $filename
            );
            $collection['pdf'] = $filename;
        }else{
            $collection['pdf']=$pdf['pdf'];
        }


            $pdf['pdf'] = $collection['pdf'];
            $pdf['chapter_id'] =$collection['chapter_id'];
            $pdf['status'] = '1';

            $pdf->save();

            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating pdf.', 'error', true, true);
        }

        // if (!$pdf) {
        //     return $this->responseRedirectBack('Error occurred while creating pdf.', 'error', true, true);
        // }



    }


    public function disable($id){
        try{
        $Pdf = Pdf::find($id);
        if($Pdf['status']=='1'){
            $Pdf['status']='0';
        }
        else{
            $Pdf['status']='1';
        }
        $Pdf->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Pdf.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Pdf = Pdf::find($id);
            $Pdf->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }
}
