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
                <form action="{{ route('admin.levels.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetLevel->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetLevel->id }}">
                            @error('level') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="program_id">program <span class="m-l-5 text-danger"> *</span></label>
                            <select id='program_id' class="form-control custom-select mt-15 @error('program_id') is-invalid @enderror" name="program_id" >
                                <option value="">select program</option>
                                @foreach($programs as $program)

                                @if($targetLevel->program_id == $program->id)
                                <option value="{{$program->id}}" selected>{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>
                                @endif


                                <option value="{{$program->id}}">{{$program->program}} ({{$program->board->title}}->{{$program->board->subtitle}})</option>

                                @endforeach
                            @error('program_id') {{ $message }} @enderror
                            </select>
                        </div>




                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Level</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.levels.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
