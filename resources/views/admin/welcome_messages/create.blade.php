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
                <form action="{{ route('admin.welcomes.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">


                        <div class="form-group">
                            <label class="control-label" for="name">name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>

                            @error('name') {{ $message }} @enderror
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="from">message from <span class="m-l-5 text-danger"> *</span></label>
                            {{-- <input class="form-control @error('from') is-invalid @enderror" type="text" name="from" id="from" value="{{ old('from') }}"/> --}}
                            <select name="from" class="form-control @error('from') is-invalid @enderror" id="from">
                                <option value="principal">Principal Message</option>
                                <option value="viceprincipal">Vice Principal Message</option>
                            </select>

                            @error('from') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="bio">Details</label>
                            <textarea id="ckeditor" class="ckeditor form-control @error('details') is-invalid @enderror " rows="4" name="details" id="details">{{ old('details') }}</textarea>
                            @error('details') {{ $message }} @enderror
                        </div>


                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg,.png,.jpeg" id="image" name="image" required/>
                            @error('image') {{ $message }} @enderror
                        </div>


                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>create welcome message</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.welcomes.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
