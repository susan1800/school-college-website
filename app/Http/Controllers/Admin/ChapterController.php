<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Chapter;
use App\Models\Pdf;
use App\Models\Subject;
use App\Models\Program;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;


class ChapterController extends BaseController
{
    public function index(){
        $chapters = Chapter::latest()->get();
        $this->setPageTitle('Chapter', 'Chapter');
        return view('admin.chapters.index', compact('chapters'));
    }



    public function create(){
        $subjects = Subject::where('status' , 1)->get();
        $programs = Program::where('status' , 1)->get();
        $this->setPageTitle('Chapter ', 'Create Chapter');
        return view('admin.chapters.create' , compact('subjects' , 'programs'));
    }
    




    public function store(Request $request){
        $this->validate($request, [
            'chapter'      =>  'required',
            'subject_id' =>  'required|int',
        ]);
        // dd($request);

        $chaptername =  explode(",",$request->chapter);
        DB::beginTransaction();
        for($i=0;$i< count($chaptername);$i++){
            if(($chaptername[$i] != "") && ($chaptername[$i] != " ") && ($chaptername[$i] != "  ") && ($chaptername[$i] != "   ") && ($chaptername != null)){
                $chapter = new Chapter();
                $chapter['chapter'] = $chaptername[$i];
                $chapter['subject_id'] = $request->subject_id;

                    $chapter->save();
            }

        }
        DB::commit();


        try {





            return $this->responseRedirect('admin.chapters.index', 'chapter added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while creating chapter.', 'error', true, true);
        }


    }
    public function edit($id){
        try {
            $subjects =Subject::where('status' , 1)->get();
            $programs =Program::where('status' , 1)->get();
            $targetChapter = Chapter::find($id);
            $this->setPageTitle('Chapter', 'Edit Chapter : '.$targetChapter->name);
            return view('admin.chapters.edit', compact('targetChapter' , 'subjects' , 'programs'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }


    public function copyChapter(Request $request){
        $this->validate($request, [
            'chapter'      =>  'required',
            'subject_id' =>  'required|int',



        ]);

        $collection = $request->except('_token');

        try {
            DB::beginTransaction();

            $chapter = Chapter::find($request->id);
            $new_chapter = new Chapter();
            $new_chapter['chapter'] = $collection['chapter'];
            $new_chapter['subject_id'] = $collection['subject_id'];
            $new_chapter['status'] = $chapter['status'];
            $new_chapter->save();

            foreach($chapter->pdf as $pdf){
                $new_pdf = new Pdf();
                $new_pdf['chapter_id'] = $new_chapter['id'];
                $new_pdf['status'] = $pdf['status'];
                $new_pdf['pdf'] = $pdf['pdf'];
                $new_pdf->save();
            }



            DB::commit();

            return $this->responseRedirectBack('Copy sucessfully.', 'sucess', true, true);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating chapter.', 'error', true, true);
        }

    }


    public function copy($id){
        try {
            $subjects =Subject::where('status' , 1)->get();
            $programs =Program::where('status' , 1)->get();
            $targetChapter = Chapter::find($id);
            $this->setPageTitle('Chapter', 'Copy Chapter : '.$targetChapter->name);
            return view('admin.chapters.edit', compact('targetChapter' , 'subjects' , 'programs'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }




    public function update(Request $request){

        $this->validate($request, [
            'chapter'      =>  'required',
            'subject_id' =>  'required|int',



        ]);

        $collection = $request->except('_token');

        try {

            $chapter = Chapter::find($request->id);




            $chapter['chapter'] = $collection['chapter'];
            $chapter['subject_id'] = $collection['subject_id'];
            $chapter['status'] = '1';


            $chapter->save();

            return $this->responseRedirect('admin.chapters.index','Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating chapter.', 'error', true, true);
        }

        // if (!$chapter) {
        //     return $this->responseRedirectBack('Error occurred while creating chapter.', 'error', true, true);
        // }



    }






    public function disable($id){
        try{
        $Chapter = Chapter::find($id);
        if($Chapter['status']=='1'){
            $Chapter['status']='0';
        }
        else{
            $Chapter['status']='1';
        }
        $Chapter->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Chapter.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Chapter = Chapter::find($id);
        if(count($Chapter->pdf) == 0){
            $Chapter->delete();
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
