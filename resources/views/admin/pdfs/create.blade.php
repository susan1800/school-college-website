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
         $countprogram = \App\Models\Program::where('status',1)->count();
         ?>


var countprogram = <?= $countprogram ?>;


for(var i=0;i<countprogram;i++){
    if(title==program[i]['id']){

            <?php
            $countsubject = \App\Models\Subject::where('status',1)->count();
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


checkchapter();
    }





    function checkchapter(){

        for(i=0;i<22;i++){
            showchapter(i);
        }



}




function showchapter(id){

    title = document.getElementById('subject').value;

var x = document.getElementById("chapter_id"+id);

var program = <?php echo json_encode($programs); ?>;
var subject = <?php echo json_encode($subjects); ?>;
var chapter = <?php echo json_encode($chapters); ?>;
<?php

 $countsubject = \App\Models\Subject::where('status',1)->count();

 ?>


var countsubject = <?= $countsubject ?>;

for(var i=0;i<countsubject;i++){
if(title== subject[i]['id']){

    <?php
    $countchapter = \App\Models\Chapter::where('status',1)->count();
    ?>

    var countchapter = <?= $countchapter ?>;

    document.getElementById("chapter_id"+id).options.length=0;
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


function addchapter(){
    var currentid = document.getElementById('hiddenid').value;
        currentid++;
    document.getElementById("hidden"+currentid).style.display = "block";
    document.getElementById('hiddenid').value = currentid;
}

function deleterow(){
    var hiddenid = document.getElementById('hiddenid').value;

    document.getElementById("hidden"+hiddenid).style.display = "none";
    hiddenid--;
    document.getElementById('hiddenid').value = hiddenid;
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
                <div style="display:flex;">
                <h3 class="tile-title col-md-6">{{ $subTitle }}</h3>
                <div class="col-md-6" >
                    <div  class="btn btn-danger" style="float:right;" onclick="deleterow()"> Remove Row </div>
                    <div class="btn btn-primary " style="float:right;" onclick="addchapter()"> Add Row </div>




                </div>
                </div>




                <form action="{{ route('admin.pdfs.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">


                        <div style="display:flex;">

                            <div class="form-group col-md-6">
                            <label class="control-label" for="program">Program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program' class="form-control custom-select mt-15 @error('program') is-invalid @enderror" name="program"  onchange="checksubject()">
                                <option value="">select program</option>
                                @foreach($programs as $program)
                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label" for="subject">subject <span class="m-l-5 text-danger"> *</span></label>
                            <select id='subject' class="form-control custom-select mt-15 @error('subject') is-invalid @enderror" name="subject" onchange="checkchapter()">
                                <option value="">select subject</option>

                            @error('subject') {{ $message }} @enderror
                            </select>
                        </div>
                        <input type="hidden" name="hiddenid" id="hiddenid" value="0">
                        </div>


                        <hr>







                        <div style="display:flex; " >

                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id0' class="form-control custom-select mt-15 @error('chapter_id0') is-invalid @enderror" name="chapter_id0" >
                                <option value="">select chapter</option>

                            @error('chapter_id0') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf0') is-invalid @enderror" type="file" accept=".pdf" id="pdf0" name="pdf0"/>
                            @error('pdf0') {{ $message }} @enderror
                        </div>
                        </div>




                        <div style="display:flex; display:none;" id="hidden1">
                            <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id1' class="form-control custom-select mt-15 @error('chapter_id1') is-invalid @enderror" name="chapter_id1" >
                                <option value="">select chapter</option>

                            @error('chapter_id1') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf1') is-invalid @enderror" type="file" accept=".pdf" id="pdf1" name="pdf1"/>
                            @error('pdf1') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>





                        <div style="display:flex; display:none;" id="hidden2">
                            <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id2' class="form-control custom-select mt-15 @error('chapter_id2') is-invalid @enderror" name="chapter_id2" >
                                <option value="">select chapter</option>

                            @error('chapter_id2') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf2') is-invalid @enderror" type="file" accept=".pdf" id="pdf2" name="pdf2"/>
                            @error('pdf2') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>






                        <div style="display:flex; display:none;" id="hidden3">
                            <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id3' class="form-control custom-select mt-15 @error('chapter_id3') is-invalid @enderror" name="chapter_id3" >
                                <option value="">select chapter</option>

                            @error('chapter_id3') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf3') is-invalid @enderror" type="file" accept=".pdf" id="pdf3" name="pdf3"/>
                            @error('pdf3') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>





                        <div style="display:flex; display:none;" id="hidden4">
                            <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id4' class="form-control custom-select mt-15 @error('chapter_id4') is-invalid @enderror" name="chapter_id4" >
                                <option value="">select chapter</option>

                            @error('chapter_id4') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf4') is-invalid @enderror" type="file" accept=".pdf" id="pdf4" name="pdf4"/>
                            @error('pdf4') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>






                        <div style="display:flex; display:none;" id="hidden5" >
                            <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id5' class="form-control custom-select mt-15 @error('chapter_id5') is-invalid @enderror" name="chapter_id5" >
                                <option value="">select chapter</option>

                            @error('chapter_id5') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf5') is-invalid @enderror" type="file" accept=".pdf" id="pdf5" name="pdf5"/>
                            @error('pdf5') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>






                        <div style="display:flex; display:none;" id="hidden6" >
                            <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id6' class="form-control custom-select mt-15 @error('chapter_id6') is-invalid @enderror" name="chapter_id6" >
                                <option value="">select chapter</option>

                            @error('chapter_id6') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf6') is-invalid @enderror" type="file" accept=".pdf" id="pdf6" name="pdf6"/>
                            @error('pdf6') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>








                        <div style="display:flex; display:none;" id="hidden7" >
                            <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id7' class="form-control custom-select mt-15 @error('chapter_id7') is-invalid @enderror" name="chapter_id7" >
                                <option value="">select chapter</option>

                            @error('chapter_id7') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf7') is-invalid @enderror" type="file" accept=".pdf" id="pdf7" name="pdf7"/>
                            @error('pdf7') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>



                            <div style="display:flex; display:none;" id="hidden8" >
                                <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id8' class="form-control custom-select mt-15 @error('chapter_id8') is-invalid @enderror" name="chapter_id8" >
                                <option value="">select chapter</option>

                            @error('chapter_id8') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf8') is-invalid @enderror" type="file" accept=".pdf" id="pdf8" name="pdf8"/>
                            @error('pdf8') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>
                             <div style="display:flex; display:none;" id="hidden9" >
                                <div style="display:flex;">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                            <select id='chapter_id9' class="form-control custom-select mt-15 @error('chapter_id9') is-invalid @enderror" name="chapter_id9" >
                                <option value="">select chapter</option>

                            @error('chapter_id9') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf9') is-invalid @enderror" type="file" accept=".pdf" id="pdf9" name="pdf9"/>
                            @error('pdf9') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>



                        <div style="display:flex; display:none;"  id="hidden10" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id10' class="form-control custom-select mt-15 @error('chapter_id10') is-invalid @enderror" name="chapter_id10" >
                            <option value="">select chapter</option>

                        @error('chapter_id10') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf10') is-invalid @enderror" type="file" accept=".pdf" id="pdf10" name="pdf10"/>
                        @error('pdf10') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>



                        <div style="display:flex; display:none;" id="hidden11" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id11' class="form-control custom-select mt-15 @error('chapter_id11') is-invalid @enderror" name="chapter_id11" >
                            <option value="">select chapter</option>

                        @error('chapter_id11') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf11') is-invalid @enderror" type="file" accept=".pdf" id="pdf11" name="pdf11"/>
                        @error('pdf11') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>



                        <div style="display:flex; display:none;" id="hidden12" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id12' class="form-control custom-select mt-15 @error('chapter_id12') is-invalid @enderror" name="chapter_id12" >
                            <option value="">select chapter</option>

                        @error('chapter_id12') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf12') is-invalid @enderror" type="file" accept=".pdf" id="pdf12" name="pdf12"/>
                        @error('pdf12') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>


                        <div style="display:flex; display:none;" id="hidden13" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id13' class="form-control custom-select mt-15 @error('chapter_id13') is-invalid @enderror" name="chapter_id13" >
                            <option value="">select chapter</option>

                        @error('chapter_id13') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf13') is-invalid @enderror" type="file" accept=".pdf" id="pdf13" name="pdf13"/>
                        @error('pdf13') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>


                        <div style="display:flex; display:none;" id="hidden14" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id14' class="form-control custom-select mt-15 @error('chapter_id14') is-invalid @enderror" name="chapter_id14" >
                            <option value="">select chapter</option>

                        @error('chapter_id14') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf14') is-invalid @enderror" type="file" accept=".pdf" id="pdf14" name="pdf14"/>
                        @error('pdf14') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>


                        <div style="display:flex;display:none;" id="hidden15" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id15' class="form-control custom-select mt-15 @error('chapter_id15') is-invalid @enderror" name="chapter_id15" >
                            <option value="">select chapter</option>

                        @error('chapter_id15') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf15') is-invalid @enderror" type="file" accept=".pdf" id="pdf15" name="pdf15"/>
                        @error('pdf15') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>


                        <div style="display:flex; display:none;"  id="hidden16" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id16' class="form-control custom-select mt-15 @error('chapter_id16') is-invalid @enderror" name="chapter_id16" >
                            <option value="">select chapter</option>

                        @error('chapter_id16') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf16') is-invalid @enderror" type="file" accept=".pdf" id="pdf16" name="pdf16"/>
                        @error('pdf16') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>


                        <div style="display:flex; display:none;" id="hidden17" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id17' class="form-control custom-select mt-15 @error('chapter_id17') is-invalid @enderror" name="chapter_id17" >
                            <option value="">select chapter</option>

                        @error('chapter_id17') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf17') is-invalid @enderror" type="file" accept=".pdf" id="pdf17" name="pdf17"/>
                        @error('pdf17') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>


                        <div style="display:flex; display:none;"  id="hidden18" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id18' class="form-control custom-select mt-15 @error('chapter_id18') is-invalid @enderror" name="chapter_id18" >
                            <option value="">select chapter</option>

                        @error('chapter_id18') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf18') is-invalid @enderror" type="file" accept=".pdf" id="pdf18" name="pdf18"/>
                        @error('pdf18') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>


                        <div style="display:flex; display:none;" id="hidden19" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6">
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id19' class="form-control custom-select mt-15 @error('chapter_id19') is-invalid @enderror" name="chapter_id19" >
                             <option value="">select chapter</option>

                        @error('chapter_id19') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf19') is-invalid @enderror" type="file" accept=".pdf" id="pdf19" name="pdf19"/>
                        @error('pdf19') {{ $message }} @enderror
                        </div>
                        </div></div>



                        <div style="display:flex; display:none;" id="hidden20" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6" >
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id20' class="form-control custom-select mt-15 @error('chapter_id20') is-invalid @enderror" name="chapter_id20" >
                            <option value="">select chapter</option>

                        @error('chapter_id20') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf20') is-invalid @enderror" type="file" accept=".pdf" id="pdf20" name="pdf20"/>
                        @error('pdf20') {{ $message }} @enderror
                        </div>
                        </div>
                    </div>



                        <div style="display:flex; display:none;" id="hidden21" >
                            <div style="display:flex;">
                        <div class="form-group col-md-6" >
                        <label class="control-label" for="chapter">chapter <span class="m-l-5 text-danger"> *</span></label>
                        <select id='chapter_id21' class="form-control custom-select mt-15 @error('chapter_id21') is-invalid @enderror" name="chapter_id21" >
                            <option value="">select chapter</option>

                        @error('chapter_id21') {{ $message }} @enderror
                        </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label class="control-label">pdf</label>
                        <input class="form-control @error('pdf21') is-invalid @enderror" type="file" accept=".pdf" id="pdf21" name="pdf21"/>
                        @error('pdf21') {{ $message }} @enderror
                        </div>
                            </div>
                        </div>

                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Pdf</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.pdfs.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
