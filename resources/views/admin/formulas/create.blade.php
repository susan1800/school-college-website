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
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.formulas.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="formula">formula <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('formula') is-invalid @enderror" type="text" name="formula" id="formula" value="{{ old('formula') }}"/>
                            @error('formula') {{ $message }} @enderror
                        </div>


                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg,.png,.jpeg" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label">pdf</label>
                            <input class="form-control @error('pdf') is-invalid @enderror" type="file" accept=".pdf" id="pdf" name="pdf"/>
                            @error('pdf') {{ $message }} @enderror
                        </div>

                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save formula</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.formulas.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
