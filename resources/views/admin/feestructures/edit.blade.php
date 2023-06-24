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
                <form action="{{ route('admin.feestructures.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div style="display:flex">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetfeestructure->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetfeestructure->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="science">science fee <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('science') is-invalid @enderror" type="text" name="science" id="science" value="{{ old('science', $targetfeestructure->science) }}"/>
                            <input type="hidden" name="id" value="{{ $targetfeestructure->id }}">
                            @error('science') {{ $message }} @enderror
                        </div>
                    </div>
                    <div style="display:flex">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="management">management fee <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('management') is-invalid @enderror" type="text" name="management" id="management" value="{{ old('management', $targetfeestructure->management) }}"/>
                            <input type="hidden" name="id" value="{{ $targetfeestructure->id }}">
                            @error('management') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="humanities">humanities fee <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('humanities') is-invalid @enderror" type="text" name="humanities" id="humanities" value="{{ old('humanities', $targetfeestructure->humanities) }}"/>
                            <input type="hidden" name="id" value="{{ $targetfeestructure->id }}">
                            @error('humanities') {{ $message }} @enderror
                        </div>
                    </div>
                    <div style="display:flex">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="bbs">BBS fee <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('bbs') is-invalid @enderror" type="text" name="bbs" id="bbs" value="{{ old('bbs', $targetfeestructure->bbs) }}"/>
                            <input type="hidden" name="id" value="{{ $targetfeestructure->id }}">
                            @error('bbs') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="remarks">remarks</label>
                            <textarea class="ckeditor form-control @error('remarks') is-invalid @enderror" rows="2" name="remarks" id="remarks">{{ old('remarks', $targetfeestructure->remarks) }}</textarea>
                            @error('remarks') {{ $message }} @enderror

                        </div>
                    </div>



                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update fee structure</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.feestructures.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

