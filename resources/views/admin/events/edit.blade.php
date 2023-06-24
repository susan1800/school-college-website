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
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.events.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">

                        <div style="display:flex">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="title">title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetevent->title) }}"/>
                            <input type="hidden" name="id" value="{{$targetevent->id}}">
                            @error('title') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="location">location <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" id="location" value="{{ old('location', $targetevent->location) }}"/>

                            @error('location') {{ $message }} @enderror
                        </div>
                    </div>


                    <div style="display:flex ">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="date">date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('date') is-invalid @enderror" type="date" name="date" id="date" value="{{ old('date', $targetevent->date) }}"/>

                            @error('date') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="time">time <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('time') is-invalid @enderror" type="time" name="time" id="time" value="{{ old('time', $targetevent->time) }}"/>

                            @error('time') {{ $message }} @enderror
                        </div>
                    </div>

                    <div style="display:flex ">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="fee">Cost <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('fee') is-invalid @enderror" type="text" name="fee" id="fee" value="{{ old('fee', $targetevent->fee) }}"/>

                            @error('fee') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="total_slots">total slots <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('total_slots') is-invalid @enderror" type="text" name="total_slots" id="total_slots" value="{{ old('total_slots', $targetevent->total_slots) }}"/>

                            @error('total_slots') {{ $message }} @enderror
                        </div>
                    </div>

                        <div class="form-group">
                            <label class="control-label" for="bio">Details</label>
                            <textarea id="ckeditor" class="ckeditor form-control @error('details') is-invalid @enderror " rows="4" name="details" id="details">{{ old('details',$targetevent->details) }}</textarea>
                            @error('details') {{ $message }} @enderror
                        </div>


                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update event</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.events.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
