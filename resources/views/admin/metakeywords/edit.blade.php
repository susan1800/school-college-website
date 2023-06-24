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
                <form action="{{ route('admin.metakeywords.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">

                            <input type="hidden" name="id" value="{{ $targetMetaKeyword->id }}">



                        <div class="form-group">
                            <label class="control-label" for="details">Keywords</label>
                            <textarea class="ckeditor form-control @error('keywords') is-invalid @enderror " rows="4" name="keywords" id="keywords">{{ old('keywords', $targetMetaKeyword->keywords) }}</textarea>
                            @error('keywords') {{ $message }} @enderror
                        </div>



                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Keyword</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.metakeywords.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
