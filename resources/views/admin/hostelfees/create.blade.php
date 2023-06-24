@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')


    <link href="node_modules/froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <script src="https://app.codox.io/plugins/wave.client.js?apiKey=your-api-key&app=froala" type="text/javascript"></script>

    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.hostelfees.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">

                        <div style="display:flex;">

                        <div class="form-group col-md-6">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            <input class="form-control " type="hidden" name="status" id="status" value="1"/>
                            @error('title') {{ $message }} @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label" for="amount">amount <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" id="amount" value="{{ old('amount') }}"/>
                            <input class="form-control " type="hidden" name="status" id="status" value="1"/>
                            @error('amount') {{ $message }} @enderror
                        </div>

                        </div>




                            <div style="display:flex;">



                                <div class="form-group col-md-12">
                                    <label class="control-label" for="remarks">remarks</label>
                                    <textarea class="ckeditor form-control @error('remarks') is-invalid @enderror " rows="2" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                                    <input class="form-control " type="hidden" name="status" id="status" value="1"/>
                                    @error('remarks') {{ $message }} @enderror
                                </div>

                                </div>






                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save data</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.hostelfees.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection



