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
                <form action="{{ route('admin.galleries.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">

                        <div style="display:flex;">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="title">title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>

                            @error('title') {{ $message }} @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label" for="location">location <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" id="location" value="{{ old('location') }}"/>

                            @error('location') {{ $message }} @enderror
                        </div>
                    </div>




                    <div style="display:flex;">
                        <div class="form-group col-md-6">
                            <label class="control-label">Image show for gallery</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg,.png,.jpeg" id="image" name="image" required/>
                            @error('image') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label"></label>
                            <input class="form-control @error('date') is-invalid @enderror" type="date" id="date" name="date">
                        </div>
                    </div>
                    {{-- <div class="form-group col-md-6">
                        <label class="control-label">Images</label>
                    <input type="file" name="images[]" multiple>
                    </div> --}}


                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>create Gallery</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.galleries.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( '.ckeditor' );
    </script>

@endsection
