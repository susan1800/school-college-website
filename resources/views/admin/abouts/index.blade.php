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
                <form action="{{ route('admin.abouts.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div style="display:flex;">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="email">email <span class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ old('email', $targetAbout->email) }}"/>
                                <input type="hidden" name="id" value="{{ $targetAbout->id }}">
                                @error('email') {{ $message }} @enderror
                            </div>

                        <div class="form-group col-md-6">
                            <label class="control-label" for="phone">phone <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ old('phone', $targetAbout->phone) }}"/>
                            @error('phone') {{ $message }} @enderror
                        </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="bio">Details</label>
                            <textarea id="ckeditor" class="ckeditor form-control @error('details') is-invalid @enderror " rows="4" name="details" id="details">{{ old('details', $targetAbout->details) }}</textarea>
                            @error('details') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label" for="map">MAP Iframe<span class="m-l-5 text-danger"> *</span></label>
                            <textarea  class="form-control @error('map') is-invalid @enderror" rows="4" name="map" id="map">{{ old('map', $targetAbout->map) }}</textarea>
                            {{-- <input class="form-control @error('map') is-invalid @enderror" type="text" name="map" id="map" value="{{ old('map', $targetAbout->map) }}"/> --}}

                            @error('map') {{ $message }} @enderror
                        </div>

                        <div style="display: flex">





                        <div class="form-group col-md-6">
                            <label class="control-label" for="location">Address <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" id="location" value="{{ old('location', $targetAbout->location) }}"/>
                            <input type="hidden" name="id" value="{{ $targetAbout->id }}">
                            @error('location') {{ $message }} @enderror
                        </div>


                        <div class="form-group col-md-6">
                            <label class="control-label" for="youtube">youtube </label>
                            <input class="form-control @error('youtube') is-invalid @enderror" type="text" name="youtube" id="youtube" value="{{ old('youtube', $targetAbout->youtube) }}"/>

                            @error('youtube') {{ $message }} @enderror
                        </div>
                        </div>


                        <div style="display: flex">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="facebook">facebook </label>
                            <input class="form-control @error('facebook') is-invalid @enderror" type="text" name="facebook" id="facebook" value="{{ old('facebook', $targetAbout->facebook) }}"/>

                            @error('facebook') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="twitter">twitter </label>
                            <input class="form-control @error('twitter') is-invalid @enderror" type="text" name="twitter" id="twitter" value="{{ old('twitter', $targetAbout->twitter) }}"/>

                            @error('twitter') {{ $message }} @enderror
                        </div>
                        </div>

                        <div style="display: flex">
                            <div class="form-group col-md-6">
                            <label class="control-label" for="linkedin">linkedin </label>
                            <input class="form-control @error('linkedin') is-invalid @enderror" type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', $targetAbout->linkedin) }}"/>

                            @error('linkedin') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="instagram">instagram </label>
                            <input class="form-control @error('instagram') is-invalid @enderror" type="text" name="instagram" id="instagram" value="{{ old('instagram', $targetAbout->instagram) }}"/>

                            @error('instagram') {{ $message }} @enderror
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetAbout->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('storage/'.$targetAbout->image) }}" id="image" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update About</button>
                        &nbsp;&nbsp;&nbsp;
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
{{-- <script src="{{url('ckeditor/ckeditor.js')}}"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script> --}}


