@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

<script>
        function checksubject(){
        var title = document.getElementById('program').value;
        var x = document.getElementById("subject_id");
        var program = <?php echo json_encode($programs); ?>;
        var subject = <?php echo json_encode($subjects); ?>;
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

            document.getElementById("subject_id").options.length=0;
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
                <form action="@if(Route::currentRouteName() == 'admin.chapters.copy') {{ route('admin.chapters.copychapter') }} @else {{ route('admin.chapters.update') }} @endif" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('chapter') is-invalid @enderror" type="text" name="chapter" id="chapter" value="{{ old('chapter', $targetChapter->chapter) }}"/>
                            <input type="hidden" name="id" value="{{ $targetChapter->id }}">
                            @error('chapter') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="program">program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program' class="form-control custom-select mt-15 @error('program') is-invalid @enderror" name="program" onchange="checksubject()">

                                @foreach($programs as $program)
                                @if($program->id == $targetChapter->subject->program_id)
                                <option value="{{$program->id}}" selected>{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>
                                @else
                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>
                                @endif

                                @endforeach
                            @error('program') {{ $message }} @enderror
                            </select>
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="subject_id">Subject <span class="m-l-5 text-danger"> *</span></label>
                            <select id='subject_id' class="form-control custom-select mt-15 @error('subject_id') is-invalid @enderror" name="subject_id" >
                                <option value="">select subject</option>
                                @foreach($subjects as $subject)
                                @if($targetChapter->subject->program_id == $subject->program_id)
                                @if($subject->id == $targetChapter->subject->id)

                                <option value="{{$subject->id}}" selected>{{$subject->subject}}</option>
                                @endif
                                <option value="{{$subject->id}}">{{$subject->subject}}</option>
                                    @endif
                                @endforeach
                            @error('subject_id') {{ $message }} @enderror
                            </select>
                        </div>




                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>@if(Route::currentRouteName() == 'admin.chapters.copy') Copy Chapter @else Update Chapter @endif </button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.chapters.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
