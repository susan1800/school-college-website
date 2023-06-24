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
                <form action="{{ route('admin.hostelfees.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div style="display:flex">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targethostelfee->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targethostelfee->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="amount">Amount <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" id="amount" value="{{ old('amount', $targethostelfee->amount) }}"/>
                            <input type="hidden" name="id" value="{{ $targethostelfee->id }}">
                            @error('amount') {{ $message }} @enderror
                        </div>
                    </div>
                    <div style="display:flex">

                        <div class="form-group col-md-12">
                            <label class="control-label" for="remarks">remarks</label>
                            <textarea class="ckeditor form-control @error('remarks') is-invalid @enderror" rows="2" name="remarks" id="remarks">{{ old('remarks', $targethostelfee->remarks) }}</textarea>
                            @error('remarks') {{ $message }} @enderror

                        </div>
                    </div>



                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update data</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.hostelfees.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

