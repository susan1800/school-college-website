@extends('admin.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>

#tags > span{
  cursor:pointer;
  display:block;
  float:left;
  color:#fff;
  background:#789;
  padding:5px;
  padding-right:25px;
  margin:4px;
}
#tags > span:hover{
  opacity:0.7;
}
#tags > span:after{
 position:absolute;
 content:"×";
 border:1px solid;
 padding:2px 5px;
 margin-left:3px;
 font-size:11px;
}

#hour > span{
  cursor:pointer;
  display:block;
  float:left;
  color:#fff;
  background:#789;
  padding:5px;
  padding-right:25px;
  margin:4px;
}
#hour > span:hover{
  opacity:0.7;
}
#hour > span:after{
 position:absolute;
 content:"×";
 border:1px solid;
 padding:2px 5px;
 margin-left:3px;
 font-size:11px;
}

    </style>
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
                <form action="{{ route('admin.chapters.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('chapter') is-invalid @enderror" type="hidden" name="chapter" id="chapter"  />

                            @error('chapter') {{ $message }} @enderror

                        <div id="tags">


                        <input type="text"  placeholder="Add a multiple chapter saperate using comma(,)" class="form-control @error('chapter') is-invalid @enderror" />
                        </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="program">Program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program' class="form-control custom-select mt-15 @error('program') is-invalid @enderror" name="program" onchange="checksubject()" required>
                                <option value="">select program</option>
                                @foreach($programs as $program)
                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

                                @endforeach
                            @error('program') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="subject_id">subject <span class="m-l-5 text-danger"> *</span></label>
                            <select id='subject_id' class="form-control custom-select mt-15 @error('subject_id') is-invalid @enderror" name="subject_id" required>
                                <option value="">select subject</option>

                            @error('subject_id') {{ $message }} @enderror
                            </select>
                        </div>




                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Chapter</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.chapters.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>

    jQuery($ => { // DOM ready and $ alias in scope.
        let data = "";
// TAGS BOX
$("#tags input").on({

  focusout() {
    var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,' '); // allowed characters
    if(txt) $("<span/>", {text:txt.toLowerCase(), insertBefore:this});
    this.value = "";

    data= data.concat(",", txt);
    document.getElementById('chapter').value = data;
  },
  keyup(ev) {
    if(/(,|Enter)/.test(ev.key)) $(this).focusout();
  }



});


$("#tags").on("click", "span", function() {
    var value = $(this).text();
    data = "";
    var removedata = document.getElementById('chapter').value;
    const split = removedata.split(",");

    for(var i=0;i<=split.length;i++){
        if(split[i] != value && split[i] != null && split[i] != "" && split[i] != " "){
            data = data+','+split[i];

        }

    }
    document.getElementById('chapter').value = data;
  $(this).remove();
});



});




jQuery($ => { // DOM ready and $ alias in scope.
        let data = "";
// TAGS BOX
$("#hour input").on({

  focusout() {
    var txt = this.value.replace(/[^0-9]/ig,''); // allowed characters
    if(txt) $("<span/>", {text:txt.toLowerCase(), insertBefore:this});
    this.value = "";

    data= data.concat(",", txt);
    document.getElementById('hours').value = data;
  },
  keyup(ev) {
    if(/(,|Enter)/.test(ev.key)) $(this).focusout();
  }



});



$("#hour").on("click", "span", function() {
    var value = $(this).text();
    data = "";
    var removedata = document.getElementById('hours').value;
    const split = removedata.split(",");

    for(var i=0;i<=split.length;i++){
        if(split[i] != value && split[i] != null && split[i] != "" && split[i] != " "){
            data = data+','+split[i];

        }

    }
    document.getElementById('hours').value = data;
  $(this).remove();
});



});


    </script>

