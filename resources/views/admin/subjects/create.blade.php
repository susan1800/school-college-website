@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<script>
        function checklevel(a){
        var title = document.getElementById('program_id'+a).value;
        var x = document.getElementById("level_id"+a);
        var program = <?php echo json_encode($programs); ?>;
        var level = <?php echo json_encode($levels); ?>;
        <?php
         $countprogram = \App\Models\Program::count();
         ?>


var countprogram = <?= $countprogram ?>;


for(var i=0;i<countprogram;i++){
    if(title==program[i]['id']){

            <?php
            $countlevel = \App\Models\Level::count();
            ?>

            var countlevel = <?= $countlevel ?>;

            document.getElementById("level_id"+a).options.length=0;
            for(var j=0;j<countlevel;j++){

                if(program[i]['id']==level[j]['program_id']){
                    var option = document.createElement("option");
                    option.value =level[j]['id'];
                    console.log(option.value);
                    option.text = level[j]['title'];
                    x.add(option);
                }

            }
        }
    }
}




function showsubject(){
    var hiddenid = document.getElementById('hiddenid').value;
    hiddenid++;
    document.getElementById("hidden"+hiddenid).style.display = "block";
    document.getElementById('hiddenid').value = hiddenid;
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
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <div style="display:flex;">
                <h3 class="tile-title col-md-6">{{ $subTitle }}</h3>
                @if(Route::currentRouteName() == 'admin.subjects.create')
                <div class="col-md-6" >
                    <div  class="btn btn-danger" style="float:right;" onclick="deleterow()"> Remove Row </div>
                    <div class="btn btn-primary " style="float:right;" onclick="showsubject()"> Add Row </div>

                </div>
                @endif
                </div>
                <form   @if(Route::currentRouteName() == 'admin.subjects.create') action="{{ route('admin.subjects.store') }}" @elseif(Route::currentRouteName() == 'admin.subjects.copy') action="{{ route('admin.subjects.copystore') }}"  @endif method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body" >
                        @if(Route::currentRouteName() == 'admin.subjects.copy')
                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                        @endif
                        @if(Route::currentRouteName() == 'admin.subjects.create')
                        <div style="display:flex;">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="subject">subject <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject" id="subject" value="{{ old('subject') }}"  required/>
                            @error('subject') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg,.png,.jpeg" id="image" name="image"  required/>
                            @error('image') {{ $message }} @enderror
                        </div>
                    </div>
                    @endif

                    <hr>



                    <div style="display:flex;">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program_id0' class="form-control custom-select mt-15 @error('program_id0') is-invalid @enderror" name="program_id0" onchange="checklevel(0)" required>
                                <option value="">select program</option>
                                @foreach($programs as $program)
                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

                                @endforeach
                            @error('program_id0') {{ $message }} @enderror
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
                            <select id='level_id0' class="form-control custom-select mt-15 @error('level_id0') is-invalid @enderror" name="level_id0" required>
                                <option value="">select Level</option>

                            @error('level_id0') {{ $message }} @enderror
                            </select>
                        </div>
                    </div>


                    <div style="display:flex;">
                        <div class="form-group col-md-6">
                            <label class="control-label">syllabus</label>
                            <input class="form-control @error('syllabus0') is-invalid @enderror" type="file" accept=".pdf" id="syllabus0" name="syllabus0"  @if(Route::currentRouteName() == 'admin.subjects.create') @endif>
                            @if(Route::currentRouteName() == 'admin.subjects.copy')
                            <a  target="blank" href="{{asset('storage/'.$subject->syllabus)}}">syllabus</a>
                            @endif
                            @error('syllabus0') {{ $message }} @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">QN Bank</label>
                            <input class="form-control @error('qn_bank0') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank0" name="qn_bank0" @if(Route::currentRouteName() == 'admin.subjects.create') @endif/>
                            @if(Route::currentRouteName() == 'admin.subjects.copy')
                            <a target="blank" href="{{asset('storage/'.$subject->qn_bank)}}">QN_Bank</a>
                            @endif
                            @error('qn_bank0') {{ $message }} @enderror
                        </div>

                    </div>











                    <div id="hidden1" style="display:none;">

                        <hr style="background: red;color:red;">


                        <div style="display:flex;">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program_id1' class="form-control custom-select mt-15 @error('program_id1') is-invalid @enderror" name="program_id1" onchange="checklevel('1')">
                                <option value="">select program</option>
                                @foreach($programs as $program)
                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

                                @endforeach
                            @error('program_id1') {{ $message }} @enderror
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
                            <select id='level_id1' class="form-control custom-select mt-15 @error('level_id1') is-invalid @enderror" name="level_id1" >
                                <option value="">select Level</option>

                            @error('level_id1') {{ $message }} @enderror
                            </select>

                        </div>


                        </div>
                        <div style="display:flex;">

                        <div class="form-group col-md-6">
                            <label class="control-label">syllabus</label>
                            <input class="form-control @error('syllabus1') is-invalid @enderror" type="file" accept=".pdf" id="syllabus1" name="syllabus1" />
                            @error('syllabus1') {{ $message }} @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">QN Bank</label>
                            <input class="form-control @error('qn_bank1') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank1" name="qn_bank1" />
                            @error('qn_bank1') {{ $message }} @enderror
                        </div>
                        </div>


                    </div>
<input type="hidden" name="hiddenid" id="hiddenid" value="0">




                        <div id="hidden2" style="display:none;">

                        <hr style="background: red;color:red;">
                        <div style="display:flex;">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program_id2' class="form-control custom-select mt-15 @error('program_id2') is-invalid @enderror" name="program_id2" onchange="checklevel('2')">
                                <option value="">select program</option>
                                @foreach($programs as $program)
                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

                                @endforeach
                            @error('program_id2') {{ $message }} @enderror
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
                            <select id='level_id2' class="form-control custom-select mt-15 @error('level_id2') is-invalid @enderror" name="level_id2" >
                                <option value="">select Level</option>

                            @error('level_id2') {{ $message }} @enderror
                            </select>
                        </div>


                        </div>
                        <div style="display:flex;">

                        <div class="form-group col-md-6">
                            <label class="control-label">syllabus</label>
                            <input class="form-control @error('syllabus2') is-invalid @enderror" type="file" accept=".pdf" id="syllabus2" name="syllabus2" />
                            @error('syllabus2') {{ $message }} @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">QN Bank</label>
                            <input class="form-control @error('qn_bank2') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank2" name="qn_bank2" />
                            @error('qn_bank2') {{ $message }} @enderror
                        </div>

                    </div>
                    </div>







                    <div id="hidden3" style="display:none;">

<hr style="background: red;color:red;">
<div style="display:flex;">
<div class="form-group col-md-6">
    <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
    <select id='program_id3' class="form-control custom-select mt-15 @error('program_id3') is-invalid @enderror" name="program_id3" onchange="checklevel('3')">
        <option value="">select program</option>
        @foreach($programs as $program)
        <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

        @endforeach
    @error('program_id3') {{ $message }} @enderror
    </select>
</div>
<div class="form-group col-md-6">
    <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
    <select id='level_id3' class="form-control custom-select mt-15 @error('level_id3') is-invalid @enderror" name="level_id3" >
        <option value="">select Level</option>

    @error('level_id3') {{ $message }} @enderror
    </select>
</div>


</div>
<div style="display:flex;">

<div class="form-group col-md-6">
    <label class="control-label">syllabus</label>
    <input class="form-control @error('syllabus3') is-invalid @enderror" type="file" accept=".pdf" id="syllabus3" name="syllabus3" />
    @error('syllabus3') {{ $message }} @enderror
</div>

<div class="form-group col-md-6">
    <label class="control-label">QN Bank</label>
    <input class="form-control @error('qn_bank3') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank3" name="qn_bank3" />
    @error('qn_bank3') {{ $message }} @enderror
</div>

</div>
</div>








<div id="hidden4" style="display:none;">

<hr style="background: red;color:red;">
<div style="display:flex;">
<div class="form-group col-md-6">
    <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
    <select id='program_id4' class="form-control custom-select mt-15 @error('program_id4') is-invalid @enderror" name="program_id4" onchange="checklevel('4')">
        <option value="">select program</option>
        @foreach($programs as $program)
        <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

        @endforeach
    @error('program_id4') {{ $message }} @enderror
    </select>
</div>
<div class="form-group col-md-6">
    <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
    <select id='level_id4' class="form-control custom-select mt-15 @error('level_id4') is-invalid @enderror" name="level_id4" >
        <option value="">select Level</option>

    @error('level_id4') {{ $message }} @enderror
    </select>
</div>


</div>
<div style="display:flex;">

<div class="form-group col-md-6">
    <label class="control-label">syllabus</label>
    <input class="form-control @error('syllabus4') is-invalid @enderror" type="file" accept=".pdf" id="syllabus4" name="syllabus4" />
    @error('syllabus4') {{ $message }} @enderror
</div>

<div class="form-group col-md-6">
    <label class="control-label">QN Bank</label>
    <input class="form-control @error('qn_bank4') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank4" name="qn_bank4" />
    @error('qn_bank4') {{ $message }} @enderror
</div>

</div>
</div>







<div id="hidden5" style="display:none;">

<hr style="background: red;color:red;">
<div style="display:flex;">
<div class="form-group col-md-6">
    <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
    <select id='program_id5' class="form-control custom-select mt-15 @error('program_id5') is-invalid @enderror" name="program_id5" onchange="checklevel('5')">
        <option value="">select program</option>
        @foreach($programs as $program)
        <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

        @endforeach
    @error('program_id5') {{ $message }} @enderror
    </select>
</div>
<div class="form-group col-md-6">
    <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
    <select id='level_id5' class="form-control custom-select mt-15 @error('level_id5') is-invalid @enderror" name="level_id5" >
        <option value="">select Level</option>

    @error('level_id5') {{ $message }} @enderror
    </select>
</div>


</div>
<div style="display:flex;">

<div class="form-group col-md-6">
    <label class="control-label">syllabus</label>
    <input class="form-control @error('syllabus5') is-invalid @enderror" type="file" accept=".pdf" id="syllabus5" name="syllabus5" />
    @error('syllabus5') {{ $message }} @enderror
</div>

<div class="form-group col-md-6">
    <label class="control-label">QN Bank</label>
    <input class="form-control @error('qn_bank5') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank5" name="qn_bank5" />
    @error('qn_bank5') {{ $message }} @enderror
</div>

</div>
</div>








<div id="hidden6" style="display:none;">

<hr style="background: red;color:red;">
<div style="display:flex;">
<div class="form-group col-md-6">
    <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
    <select id='program_id6' class="form-control custom-select mt-15 @error('program_id6') is-invalid @enderror" name="program_id6" onchange="checklevel('6')">
        <option value="">select program</option>
        @foreach($programs as $program)
        <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

        @endforeach
    @error('program_id6') {{ $message }} @enderror
    </select>
</div>
<div class="form-group col-md-6">
    <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
    <select id='level_id6' class="form-control custom-select mt-15 @error('level_id6') is-invalid @enderror" name="level_id6" >
        <option value="">select Level</option>

    @error('level_id6') {{ $message }} @enderror
    </select>
</div>


</div>
<div style="display:flex;">

<div class="form-group col-md-6">
    <label class="control-label">syllabus</label>
    <input class="form-control @error('syllabus6') is-invalid @enderror" type="file" accept=".pdf" id="syllabus6" name="syllabus6" />
    @error('syllabus6') {{ $message }} @enderror
</div>

<div class="form-group col-md-6">
    <label class="control-label">QN Bank</label>
    <input class="form-control @error('qn_bank6') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank6" name="qn_bank6" />
    @error('qn_bank6') {{ $message }} @enderror
</div>

</div>
</div>








<div id="hidden7" style="display:none;">

<hr style="background: red;color:red;">
<div style="display:flex;">
<div class="form-group col-md-6">
    <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
    <select id='program_id7' class="form-control custom-select mt-15 @error('program_id7') is-invalid @enderror" name="program_id7" onchange="checklevel('7')">
        <option value="">select program</option>
        @foreach($programs as $program)
        <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

        @endforeach
    @error('program_id7') {{ $message }} @enderror
    </select>
</div>
<div class="form-group col-md-6">
    <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
    <select id='level_id7' class="form-control custom-select mt-15 @error('level_id7') is-invalid @enderror" name="level_id7" >
        <option value="">select Level</option>

    @error('level_id7') {{ $message }} @enderror
    </select>
</div>


</div>
<div style="display:flex;">

<div class="form-group col-md-6">
    <label class="control-label">syllabus</label>
    <input class="form-control @error('syllabus7') is-invalid @enderror" type="file" accept=".pdf" id="syllabus7" name="syllabus7" />
    @error('syllabus7') {{ $message }} @enderror
</div>

<div class="form-group col-md-6">
    <label class="control-label">QN Bank</label>
    <input class="form-control @error('qn_bank7') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank7" name="qn_bank7" />
    @error('qn_bank7') {{ $message }} @enderror
</div>

</div>
</div>





<style>
                            #container {
                                width: 100%;
                                margin: 20px auto;
                            }
                            .ck-editor__editable[role="textbox"] {
                                /* editing area */
                                min-height: 300px;
                                max-height: 500px;
                            }

                        </style>


                        <div id="container">
                            <textarea id="editor" name="details">{{ old('details') }}</textarea>
                        </div>


                        <script src="https://cdn.ckbox.io/CKBox/1.5.0/ckbox.js"></script>
                        <!--
                            The "super-build" of CKEditor 5 served via CDN contains a large set of plugins and multiple editor types.
                            See https://ckeditor.com/docs/ckeditor5/latest/installation/getting-started/quick-start.html#running-a-full-featured-editor-from-cdn
                        -->
                        <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>
                        <script>
                            // This sample still does not showcase all CKEditor 5 features (!)
                            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
                            CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                                toolbar: {
                                    items: [
                                        'ckbox', 'uploadImage', '|',
                                        'exportPDF','exportWord', '|',
                                        'findAndReplace', 'selectAll', '|',
                                        'heading', '|',
                                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                                        'bulletedList', 'numberedList', 'todoList', '|',
                                        'outdent', 'indent', '|',
                                        'undo', 'redo',
                                        '-',
                                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                        'alignment', '|',
                                        'link', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                                        'textPartLanguage', '|',
                                        'sourceEditing'
                                    ],
                                    shouldNotGroupWhenFull: true
                                },
                                list: {
                                    properties: {
                                        styles: true,
                                        startIndex: true,
                                        reversed: true
                                    }
                                },
                                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                                heading: {
                                    options: [
                                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                                    ]
                                },
                                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                                placeholder: 'Welcome to CKEditor 5 + CKBox!',
                                ckbox: {
                                    // The development token endpoint is a special endpoint to help you in getting started with
                                    // CKEditor Cloud Services.
                                    // Please note the development token endpoint returns tokens with the CKBox administrator role.
                                    // It offers unrestricted, full access to the service and will expire 30 days after being used for the first time.
                                    // -------------------------------------------------------------
                                    // !!! You should not use it on production !!!
                                    // -------------------------------------------------------------
                                    // Read more: https://ckeditor.com/docs/ckbox/latest/guides/configuration/authentication.html#token-endpoint

                                    // You need to provide your own token endpoint here
                                    tokenUrl: 'https://97696.cke-cs.com/token/dev/8J5vJkhvZHzZJmoqoIrxfyPWJMPAp2FT3MOd?limit=10'
                                },
                                // The "super-build" contains more premium features that require additional configuration, disable them below.
                                // Do not turn them on unless you red the documentation and know how to configure them and setup the editor.
                                removePlugins: [
                                    // These two are commercial, but you can try them out without registering to a trial.
                                    // 'ExportPdf',
                                    // 'ExportWord',
                                    'EasyImage',
                                    'RealTimeCollaborativeComments',
                                    'RealTimeCollaborativeTrackChanges',
                                    'RealTimeCollaborativeRevisionHistory',
                                    'PresenceList',
                                    'Comments',
                                    'TrackChanges',
                                    'TrackChangesData',
                                    'RevisionHistory',
                                    'Pagination',
                                    'FormatPainter',
                                    'SlashCommand',
                                    'TableOfContents',
                                    'Template',
                                    'DocumentOutline',
                                    'WProofreader',
                                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                                    'MathType'
                                ]
                            });
                        </script>

                    </div>

                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save subject</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.subjects.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




