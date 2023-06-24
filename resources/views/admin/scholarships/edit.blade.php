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
                <form action="{{ route('admin.scholarships.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div style="display:flex">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetScholarship->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetScholarship->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="quota">Quota <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('quota') is-invalid @enderror" type="text" name="quota" id="quota" value="{{ old('quota', $targetScholarship->quota) }}"/>
                            <input type="hidden" name="id" value="{{ $targetScholarship->id }}">
                            @error('quota') {{ $message }} @enderror
                        </div>
                    </div>


                        <div style="display:flex">



                            <div class="form-group col-md-6">
                                <label class="control-label" for="waive">waive <span class="m-l-5 text-danger"> *</span></label>
                                <textarea class="ckeditor form-control @error('waive') is-invalid @enderror" rows="2" name="waive" id="waive">{{ old('waive', $targetScholarship->waive) }}</textarea>
                                @error('waive') {{ $message }} @enderror
                            </div>



                            <div class="form-group col-md-6">
                                <label class="control-label" for="eligibility">eligibility <span class="m-l-5 text-danger"> *</span></label>
                                <textarea class="ckeditor form-control @error('eligibility') is-invalid @enderror" rows="2" name="eligibility" id="eligibility">{{ old('eligibility', $targetScholarship->eligibility) }}</textarea>
                                @error('eligibility') {{ $message }} @enderror

                            </div>

                    </div>

                    <div class="form-group ">
                        <label class="control-label" for="remarks">remarks</label>
                        <textarea class="ckeditor form-control @error('remarks') is-invalid @enderror" rows="2" name="remarks" id="remarks">{{ old('remarks', $targetScholarship->remarks) }}</textarea>
                        @error('remarks') {{ $message }} @enderror

                    </div>



                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Scholarship</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.scholarships.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

