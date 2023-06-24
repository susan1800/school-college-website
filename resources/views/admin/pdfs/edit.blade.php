@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')


<script type="text/javascript">
    function checksubject(){
        var title = document.getElementById('program').value;
        var x = document.getElementById("subject");
        var program = <?php echo json_encode($programs); ?>;
        var subject = <?php echo json_encode($subjects); ?>;
        var chapter = <?php echo json_encode($chapters); ?>;
        <?php
         $countprogram = \App\Models\Program::where('status' , 1)->count();
         ?>


var countprogram = <?= $countprogram ?>;


for(var i=0;i<countprogram;i++){
    if(title==program[i]['id']){

            <?php
            $countsubject = \App\Models\Subject::where('status' , 1)->count();
            ?>

            var countsubject = <?= $countsubject ?>;

            document.getElementById("subject").options.length=0;
            for(var j=0;j<countsubject;j++){

                if(program[i]['id']==subject[j]['program_id']){
                    var option = document.createElement("option");
                    option.value =subject[j]['id'];
                    console.log(option.value);
                    option.text = subject[j]['subject'];
                    x.add(option);
                }


            }
        }
}

title = document.getElementById('subject').value;
        var x = document.getElementById("chapter_id");
        document.cookie = "id=".title;
        <?php
         $countsubject = \App\Models\Subject::where('status' , 1)->count();


         ?>

var countsubject = <?= $countsubject ?>;

for(var i=0;i<countsubject;i++){
    if(title==subject[i]['id']){

            <?php
            $countchapter = \App\Models\Chapter::where('status' , 1)->count();
            ?>


            var countchapter = <?= $countchapter ?>;

            document.getElementById("chapter_id").options.length=0;
            for(var j=0;j<countchapter;j++){

                if(subject[i]['id']==chapter[j]['subject_id']){
                    var option = document.createElement("option");
                    option.value =chapter[j]['id'];
                    console.log(option.value);
                    option.text = chapter[j]['chapter'];
                    x.add(option);
                }


            }
        }
}


    }
    function checkchapter(){

        title = document.getElementById('subject').value;
        var x = document.getElementById("chapter_id");

        var program = <?php echo json_encode($programs); ?>;
        var subject = <?php echo json_encode($subjects); ?>;
        var chapter = <?php echo json_encode($chapters); ?>;
        <?php

         $countsubject = \App\Models\Subject::where('status' , 1)->count();

         ?>


var countsubject = <?= $countsubject ?>;

for(var i=0;i<countsubject;i++){
    if(title==subject[i]['id']){

            <?php
            $countchapter = \App\Models\Chapter::where('status' , 1)->count();
            ?>

            var countchapter = <?= $countchapter ?>;

            document.getElementById("chapter_id").options.length=0;
            for(var j=0;j<countchapter;j++){

                if(subject[i]['id']==chapter[j]['subject_id']){
                    var option = document.createElement("option");
                    option.value =chapter[j]['id'];
                    console.log(option.value);
                    option.text = chapter[j]['chapter'];
                    x.add(option);
                }


            }
        }
}
}
</script>

    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form  @if(Route::currentRouteName() != 'admin.pdfs.getcopy') action="{{ route('admin.pdfs.update') }}" @else action="{{ route('admin.pdfs.copy') }}" @endif method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">

                    <input type="hidden" name="id" id="id" value="{{$targetPdf->id}}">

                    <div class="form-group">
                            <label class="control-label" for="program">Program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program' class="form-control custom-select mt-15 @error('program') is-invalid @enderror" name="program" onchange="checksubject()">
                                <option value="">select program</option>
                                @foreach($programs as $program)
                                @if($targetPdf->chapter->subject->program_id == $program->id)
                                <option value="{{$program->id}}" selected>{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>
                                @else
                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>
                                @endif



                                @endforeach
                            @error('program') {{ $message }} @enderror
                            </select>
                        </div>



                        <div class="form-group">
                            <label class="control-label" for="subject">Subject <span class="m-l-5 text-danger"> *</span></label>
                            <select id='subject' class="form-control custom-select mt-15 @error('subject') is-invalid @enderror" name="subject" onchange="checkchapter()">
                                <option value="">select subject</option>
                                @foreach($subjects as $subject)
                                @if($targetPdf->chapter->subject->program_id == $subject->program_id)
                                @if($targetPdf->chapter->subject_id == $subject->id)
                                <option value="{{$subject->id}}" selected>{{$subject->subject}} </option>
                                @else
                                <option value="{{$subject->id}}">{{$subject->subject}} </option>
                                @endif
                                @endif

                                @endforeach
                            @error('subject') {{ $message }} @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>

                            <select id='chapter_id' class="form-control custom-select mt-15 @error('chapter_id') is-invalid @enderror" name="chapter_id">

                                <option value="">select chapter</option>
                                @foreach($chapters as $chapter)
                                @if($targetPdf->chapter->subject_id == $chapter->subject_id)
                                @if($targetPdf->chapter_id == $chapter->id)
                                <option value="{{$chapter->id}}" selected>{{$chapter->chapter}} </option>
                                @endif
                                <option value="{{$chapter->id}}">{{$chapter->chapter}} </option>
                                @endif
                                @endforeach
                            @error('chapter_id') {{ $message }} @enderror
                            </select>
                        </div>




                        @if(Route::currentRouteName() != 'admin.pdfs.getcopy')

                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-10">
                                    <label class="control-label">pdf</label>
                                    <input class="form-control @error('pdf') is-invalid @enderror" type="file" accept=".pdf" id="pdf" name="pdf"/>
                                    <a href="{{asset('storage/pdf/'.$targetPdf->pdf )}}" target="blank">View PDF</a>
                                    @error('pdf') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                        @endif






                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>@if(Route::currentRouteName() != 'admin.pdfs.getcopy') Update Pdf @else Copy Pdf @endif</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.pdfs.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
