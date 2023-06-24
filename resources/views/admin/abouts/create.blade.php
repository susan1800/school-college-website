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
                <form action="{{ route('admin.abouts.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">




                        <div class="form-group">
                            <label class="control-label" for="details">Details</label>
                            <textarea class="ckeditor form-control @error('details') is-invalid @enderror " rows="4" name="details" id="details">{{ old('details') }}</textarea>
                            @error('details') {{ $message }} @enderror
                        </div>


                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="facebook">Facebook <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('facebook') is-invalid @enderror" type="text" name="facebook" id="facebook" value="{{ old('facebook') }}"/>
                            @error('facebook') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="instagram">Instagram <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('instagram') is-invalid @enderror" type="text" name="instagram" id="instagram" value="{{ old('instagram') }}"/>
                            @error('instagram') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="youtube">youtube <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('youtube') is-invalid @enderror" type="text" name="youtube" id="youtube" value="{{ old('youtube') }}"/>
                            @error('youtube') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save About</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.abouts.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
