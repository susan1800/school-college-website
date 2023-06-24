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
                <form action="{{ route('admin.categories.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('ttlei') }}"/>
                            @error('title') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="subtitle">Subtitle <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('subtitle') is-invalid @enderror" type="text" name="subtitle" id="subtitle" value="{{ old('ttlei') }}"/>
                            @error('subtitle') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                           
                            <input class="form-control " type="hidden" name="status" id="status" value="1"/>
                            
                        </div>
                     
                        
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
