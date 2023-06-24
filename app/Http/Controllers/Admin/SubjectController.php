<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\Program;
use App\Models\Chapter;
use App\Models\Pdf;
use App\Models\Level;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class SubjectController extends BaseController
{
    public function index(){
        $subjects = Subject::get(['id','subject','image','program_id','level_id','status','syllabus','qn_bank']);
        $this->setPageTitle('Subject', 'Subject');
        return view('admin.subjects.index', compact('subjects'));
    }



    public function copySubject($id){
        $subject = Subject::find($id);
        $programs = Program::where('status' , 1)->get();
        $levels = Level::where('status' , 1)->get();
        $this->setPageTitle('Subject', 'Copy Subject');
        return view('admin.subjects.create' , compact('programs','levels','subject'));

    }
    public function copystore(Request $request){

        $this->validate($request, [
            'subject_id'      =>  'required',
            'program_id0'      =>  'required',
            'level_id0'  => 'required',
        ]);


        try {

        DB::beginTransaction();
        $subject = Subject::find($request->subject_id);

        $createsubject = new Subject();
        $createsubject['subject'] = $subject['subject'];
        $createsubject['image'] = $subject['image'];
        $createsubject['details'] = $subject['details'];
        $createsubject['program_id'] = $request['program_id0'];
        $createsubject['level_id'] = $request['level_id0'];

        if($request->file('syllabus0')){
            $filename = null;
            $uploadedFile = $request->file('syllabus0');
            $filename = time().'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'subject',
                $uploadedFile,
                $filename
            );

            $createsubject['syllabus'] = 'subject/'.$filename;
        }else{
            $createsubject['syllabus'] = $subject['syllabus'];
        }


        if($request->file('qn_bank0')){
            $uploadedFile = $request->file('qn_bank0');
            $filename = time().'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'subject/qnbank',
                $uploadedFile,
                $filename
            );


            $createsubject['qn_bank'] = 'subject/qnbank/'.$filename;
        }
        else{
            $createsubject['qn_bank'] = $subject['qn_bank'];
        }


        $createsubject->save();

        foreach($subject->chapter as $chapter){
            $createchapter = new Chapter();
            $createchapter['subject_id'] = $createsubject->id;
            $createchapter['chapter'] = $chapter['chapter'];
            $createchapter['status'] = $chapter['status'];
            $createchapter->save();

            foreach($chapter->pdf as $pdf){
                $createpdf = new Pdf();
                $createpdf['chapter_id'] = $createchapter->id;
                $createpdf['pdf'] = $pdf['pdf'];
                $createpdf['status'] = $pdf['status'];
                $createpdf->save();
            }

        }



        DB::commit();


        return $this->responseRedirect('admin.subjects.index', 'subject added successfully' ,'success',false, false);

    } catch (QueryException $exception) {

        return $this->responseRedirectBack('Error occurred while creating subject.', 'error', true, true);
    }

    }




    public function create(){
        $programs = Program::where('status' , 1)->get();
        $levels = Level::where('status' , 1)->get();
        $this->setPageTitle('Subject', 'Create Subject');
        return view('admin.subjects.create' , compact('programs','levels'));
    }




    public function store(Request $request){
        $this->validate($request, [
            'hiddenid'      =>  'required',
            'subject'      =>  'required',
            'image'  => 'required',
        ]);


        try {

        DB::beginTransaction();

        for($i=0; $i<=$request->hiddenid;$i++){
        $this->validate($request, [
            'program_id'.$i =>  'required',
            'level_id'.$i  => 'required',
        ]);


        $collection = $request->except('_token');

            if($request->file('syllabus'.$i)){
            $filename = null;
            $uploadedFile = $request->file('syllabus'.$i);
            $filename = time().'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'subject',
                $uploadedFile,
                $filename
            );

            $collection['syllabus'] = 'subject/'.$filename;
        }else{
            $collection['syllabus'] = "subject/default/syllabus.pdf";
        }




            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'subject/image',
                $uploadedFile,
                $filename
            );


            $collection['image'] = 'subject/image/'.$filename;




            if($request->file('qn_bank'.$i)){
            $uploadedFile = $request->file('qn_bank'.$i);
            $filename = time().'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'subject/qnbank',
                $uploadedFile,
                $filename
            );


            $collection['qn_bank'] = 'subject/qnbank/'.$filename;
        }
        else{
            $collection['qn_bank'] = 'subject/default/qn_bank.pdf';
        }



            $subject = new Subject();
            $subject['subject'] = $request->subject;
            $subject['program_id'] = $request['program_id'.$i];
            $subject['level_id'] = $request['level_id'.$i];
            $subject['image'] = $collection['image'];
            $subject['qn_bank'] = $collection['qn_bank'];
            $subject['syllabus'] = $collection['syllabus'];
            $subject['details'] = $collection['details'];
            $subject['status'] = 1;
            // dd($subject);
            $subject->save();



            $chapter = new Chapter;
            $chapter['subject_id'] = $subject->id;
            $chapter['chapter'] = "full notes";
            $chapter['status'] = '1';
            $chapter->save();

    }


            DB::commit();


            return $this->responseRedirect('admin.subjects.index', 'subject added successfully' ,'success',false, false);

        } catch (QueryException $exception) {

            return $this->responseRedirectBack('Error occurred while creating subject.', 'error', true, true);
        }

    }
    public function edit($id){
        try {
            $targetSubject = Subject::find($id);
            $programs = Program::where('status' , 1)->get();
            $levels = Level::where('status',1)->get();
            $selectedlevel = Level::where('program_id' , $targetSubject->program_id)->where('status',1)->get();
            $this->setPageTitle('Subject', 'Edit Subject : '.$targetSubject->name);
            return view('admin.subjects.edit', compact('targetSubject' , 'programs' , 'levels' , 'selectedlevel'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $validated = $request->validate([
            'subject'      =>  'required',
            'program_id' =>  'required',
            'level_id' => 'required',
        ]);


        $collection = $request->except('_token');

        try {

            $subject = Subject::find($request->id);

            if($request->file('syllabus')){
            $filename = null;
            $uploadedFile = $request->file('syllabus');
            $filename = time().'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'subject',
                $uploadedFile,
                $filename
            );
            $filePath0 = $subject['syllabus'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);

            $collection['syllabus'] = 'subject/'.$filename;
        }
        else{
                $collection['syllabus'] =$subject->syllabus;
        }


        if($request->file('qn_bank')){
            $filename = null;
            $uploadedFile = $request->file('qn_bank');
            $filename = time().'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'subject/qnbank',
                $uploadedFile,
                $filename
            );
            $filePath = $subject['qn_bank'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);

            $collection['qn_bank'] = 'subject/qnbank/'.$filename;
        }
        else{
                $collection['qn_bank'] =$subject->qn_bank;
        }


        if($request->file('image')){
            $filename = null;
            $uploadedFile = $request->file('image');
            $filename = time().Str::random(10).'.'. $uploadedFile->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'subject/image',
                $uploadedFile,
                $filename
            );
            $filePath1 = $subject['image'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);

            $collection['image'] = 'subject/image/'.$filename;
        }
        else{
                $collection['image'] =$subject->image;
        }




            $subject['subject'] = $collection['subject'];
            $subject['program_id'] = $collection['program_id'];
            $subject['level_id'] = $collection['level_id'];
            $subject['syllabus'] = $collection['syllabus'];
            $subject['qn_bank'] = $collection['qn_bank'];
            $subject['image'] = $collection['image'];
            $subject['details'] = $collection['details'];
            $subject['status'] = '1';


            $subject->save();

            if($request->file('image')){
                Storage::delete('public/'.$filePath1);

            }
            if($request->file('qn_bank')){
                if($filePath != "subject/default/qn_bank.pdf"){
                    Storage::delete('public/'.$filePath);

                }

            }
            if($request->file('syllabus')){
                if($filePath0 != "subject/default/syllabus.pdf"){
                    Storage::delete('public/'.$filePath0);

                }
            }
            return $this->responseRedirect('admin.subjects.index', 'Update sucessfully.' ,'success',false, false);


        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating subject.', 'error', true, true);
        }





    }


    public function upload(Request $request){


        $this->validate($request, [
            'subjectid'      =>  'required',

            'syllabus.'     =>  'mimes:pdf',
            'qn_bank.'     =>  'mimes:pdf',


        ]);

    try{
        $subject = Subject::find($request->subjectid);

        if($request->file('syllabus')){
            $filename = null;
            $uploadedFile = $request->file('syllabus');
            $filename = time().'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'subject',
                $uploadedFile,
                $filename
            );

            $filePath0 = $subject['syllabus'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);

            $subject['syllabus'] = 'subject/'.$filename;
        }
        else{
                $subject['syllabus'] =$subject->syllabus;
        }


        if($request->file('qn_bank')){
            $filename = null;
            $uploadedFile = $request->file('qn_bank');
            $filename = time().'_'.$uploadedFile->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'subject/qnbank',
                $uploadedFile,
                $filename
            );
            $filePath = $subject['qn_bank'];
            // unlink('/storage/app/public/fileupload/'.$blog['name']);

            $subject['qn_bank'] = 'subject/qnbank/'.$filename;
        }
        else{
                $subject['qn_bank'] =$subject->qn_bank;
        }



        $subject->save();


        if($request->file('qn_bank')){
            if($filePath != "subject/default/qn_bank.pdf"){
                // unlink($filePath);
                // if(Storage::exists($filePath)){
                    Storage::delete('public/'.$filePath);
                // }
            }

        }
        if($request->file('syllabus')){
            if($filePath0 != "subject/default/syllabus.pdf"){

                // if(Storage::exists($filePath0)){
                    Storage::delete('public/'.$filePath0);


                // }
            }

        }
        return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

    }
    catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating subject.', 'error', true, true);
    }



    }





    public function disable($id){
        try{
        $Subject = Subject::find($id);
        if($Subject['status']=='1'){
            $Subject['status']='0';
        }
        else{
            $Subject['status']='1';
        }

        $Subject->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Subject.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Subject = Subject::find($id);
        if(count($Subject->chapter) == 0){
            $Subject->delete();
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
