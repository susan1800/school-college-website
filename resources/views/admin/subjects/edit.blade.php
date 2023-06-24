@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')






    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.subjects.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="subject">subject <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject" id="subject" value="{{ old('subject', $targetSubject->subject) }}"/>
                            <input type="hidden" name="id" value="{{ $targetSubject->id }}">
                            @error('subject') {{ $message }} @enderror
                        </div>


                        <div style="display:flex;">

                            <div class="form-group col-md-6">
                            <label class="control-label" for="program_id">Program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program_id' class="form-control custom-select mt-15 @error('program_id') is-invalid @enderror" name="program_id"  onchange="checklevel();">
                                <option value="">select program</option>
                                @foreach($programs as $program)
                                @if($program->id == $targetSubject->program_id)
                                <option value="{{$program->id}}" selected>{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>
                               @else
                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>
                                @endif

                                @endforeach
                            @error('program_id') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label" for="level_id">Level <span class="m-l-5 text-danger"> *</span></label>
                            <select id='level_id' class="form-control custom-select mt-15 @error('level_id') is-invalid @enderror" name="level_id" >
                                @foreach ($selectedlevel as $level)
                                @if($level->id == $targetSubject->level_id)
                                <option value="{{$level->id}}" selected>{{$level->title}} </option>
                                {{-- <option value="{{$level->id}}" selected> {{$level->title }}</option> --}}
                                @else
                                <option value="{{$level->id}}"> {{$level->title }}</option>
                                @endif

                                @endforeach


                            </select>
                            @error('level_id') {{ $message }} @enderror
                        </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetSubject->syllabus != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('storage/'.$targetSubject->image) }}" id="image" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>

                            </div>
                        </div>
                        <div style="display:flex;">

                            <div class="form-group col-md-6">
                            <div class="row">

                                <div class="col-md-10">
                                    <label class="control-label">Syllabus</label>
                                    <input class="form-control @error('syllabus') is-invalid @enderror" type="file" accept=".pdf" id="syllabus" name="syllabus"/>
                                    @if ($targetSubject->syllabus == "subject/default/syllabus.pdf")
                                    <a href="{{asset('storage/'.$targetSubject->syllabus )}}" target="blank">D-syllabus </a>
                                    @else
                                    <a href="{{asset('storage/'.$targetSubject->syllabus )}}" target="blank"> syllabus </a>
                                    @endif
                                    @error('syllabus') {{ $message }} @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">

                                <div class="col-md-10">
                                    <label class="control-label">QN_Bank</label>
                                    <input class="form-control @error('qn_bank') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank" name="qn_bank"/>
                                    @if ($targetSubject->qn_bank == "subject/default/qn_bank.pdf")
                                        <a href="{{asset('storage/'.$targetSubject->qn_bank )}}" target="blank">D-QN_Bank </a>
                                        @else
                                        <a href="{{asset('storage/'.$targetSubject->qn_bank )}}" target="blank">QN_Bank </a>
                                        @endif
                                    @error('qn_bank') {{ $message }} @enderror
                                </div>

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
                            <textarea id="editor" name="details">{{ old('details', $targetSubject->details) }}</textarea>
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
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Subject</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.subjects.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




<script>

    function checklevel(){

    var title = document.getElementById("program_id").value;

    var x = document.getElementById("level_id");
    var program = <?php echo json_encode($programs); ?>;
    var subject = <?php echo json_encode($targetSubject); ?>;
    var level = <?php echo json_encode($levels); ?>;
    <?php
     $countprogram = \App\Models\Program::where('status' , 1)->count();
     ?>


        var countprogram = <?= $countprogram ?>;


    for(var i=0;i<countprogram;i++){
    if(title == program[i]['id']){

            <?php
            $countlevel = \App\Models\Level::where('status' , 1 )->count();
            ?>

            var countlevel = <?= $countlevel ?>;

            document.getElementById("level_id").options.length=0;
            for(var j=0;j<countlevel;j++){
                    var k = 1;
                if(program[i]['id'] == level[j]['program_id']){
                    var option = document.createElement("option");
                    option.value =level[j]['id'];
                    option.text = level[j]['title'];

                    x.add(option);

                }

            }
        }
    }
    }

</script>
