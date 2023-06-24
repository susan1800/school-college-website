@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    <link href="node_modules/froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <script src="https://app.codox.io/plugins/wave.client.js?apiKey=your-api-key&app=froala" type="text/javascript"></script>

    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.blogs.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">

                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetBlog->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetBlog->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>


                        <div style="display:flex">


                        <div class="form-group col-md-6">
                            <label for="parent">Category <span class="m-l-5 text-danger"> *</span></label>
                            <select id=category_id class="form-control custom-select mt-15 @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="">category</option>
                                @foreach($categories as $category)
                                    @if ($targetBlog->category_id == $category->id)
                                        <option value="{{ $category->id }}" selected> {{ $category->title }} </option>
                                    @else
                                    @if(($category->status==1))
                                        <option value="{{ $category->id }}"> {{ $category->title }} </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @error('user_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">user <span class="m-l-5 text-danger"> *</span></label>
                            <select id=user_id class="form-control custom-select mt-15 @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="">user</option>
                                @foreach($users as $user)
                                    @if ($targetBlog->user_id == $user->id)
                                        <option value="{{ $user->id }}" selected> {{ $user->name }} </option>
                                    @else
                                    @if(($user->status==1))
                                        <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @error('user_id') {{ $message }} @enderror
                        </div>

                    </div>

                        <div class="form-group">
                            <label class="control-label" for="details">Details</label>
                            {{-- <textarea class="ckeditor form-control @error('details') is-invalid @enderror" rows="7" name="details" id="details">{{ old('details', $targetBlog->details) }}</textarea> --}}
                            @error('details') {{ $message }} @enderror


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
    <textarea id="editor" class="ckeditor form-control @error('details') is-invalid @enderror " rows="4" name="details" id="details">{{ old('details', $targetBlog->details) }}</textarea>
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



                        <div class="form-group">
                            <label class="control-label" for="about_author">about_author <span class="m-l-5 text-danger"> *</span></label>
                            {{-- <textarea class="ckeditor form-control @error('about_author') is-invalid @enderror" rows="4" name="about_author" id="about_author">{{ old('about_author', $targetBlog->about_author) }}</textarea> --}}
                            @error('about_author') {{ $message }} @enderror


                            <div id="container">
                                <textarea id="editor1" class="ckeditor form-control @error('about_author') is-invalid @enderror " rows="4" name="about_author">{{ old('about_author', $targetBlog->about_author) }}</textarea>
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
                                CKEDITOR.ClassicEditor.create(document.getElementById("editor1"), {
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

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetBlog->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('storage/'.$targetBlog->image) }}" id="pic" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg,.png,.jpeg" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Blog</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.blogs.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
