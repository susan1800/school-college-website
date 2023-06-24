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
                <form action="{{ route('admin.advertisements.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetAdvertisement->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetAdvertisement->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="details">Details</label>
                            <textarea class="form-control" rows="4" name="details" id="details">{{ old('details', $targetAdvertisement->details) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="lat">latitude <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lat') is-invalid @enderror" type="text" name="lat" id="lat" value="{{ old('lat', $targetAdvertisement->lat) }}"/>
                            <input type="hidden" name="id" value="{{ $targetAdvertisement->id }}">
                            @error('lat') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="long">Longitude <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('long') is-invalid @enderror" type="text" name="long" id="long" value="{{ old('long', $targetAdvertisement->long) }}"/>
                            <input type="hidden" name="id" value="{{ $targetAdvertisement->id }}">
                            @error('long') {{ $message }} @enderror
                        </div>




                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetAdvertisement->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('storage/'.$targetAdvertisement->image) }}" id="image" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg,.png,.jpeg" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Advertisement</button>
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
