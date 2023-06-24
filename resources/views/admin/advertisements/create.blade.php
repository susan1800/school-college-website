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
                <form action="{{ route('admin.advertisements.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="details">Details <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('details') is-invalid @enderror" type="text" name="details" id="details" value="{{ old('details') }}"/>
                            @error('details') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="lat">latitude <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lat') is-invalid @enderror" type="text" name="lat" id="lat" value="{{ old('lat') }}"/>
                            @error('lat') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="long">longitude <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('long') is-invalid @enderror" type="text" name="long" id="long" value="{{ old('long') }}"/>
                            @error('long') {{ $message }} @enderror
                        </div>


                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg,.png,.jpeg" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save About</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.advertisements.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
