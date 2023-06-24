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
        <div class="col-md-10 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.formulas.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="formula">formula <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('formula') is-invalid @enderror" type="text" name="formula" id="formula" value="{{ old('formula', $targetFormula->formula) }}"/>
                            <input type="hidden" name="id" value="{{ $targetFormula->id }}">
                            @error('formula') {{ $message }} @enderror
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetFormula->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('storage/'.$targetFormula->image) }}" id="image" class="img-fluid" alt="img">
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


                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-10">
                                    <label class="control-label">pdf</label>
                                    <input class="form-control @error('pdf') is-invalid @enderror" type="file" accept=".pdf" id="pdf" name="pdf"/>
                                    @error('pdf') {{ $message }} @enderror
                                    @if ($targetFormula->pdf != null)
                                       <a target="blank" href="{{asset('storage/'.$targetFormula->pdf)}}">View Pdf</a>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update formula</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.formulas.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
