@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<style>
    .show {
  display: block;
}
    </style>
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.boards.create') }}" class="btn btn-primary pull-right">Add board</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr >
                            <th> # </th>
                            <th > Title </th>
                            <th> subtitle </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                        @foreach($boards as $board)
                            @if ($board->id != 0)
                                <tr >
                                    <td>{{ $board->id }}</td>
                                    <td >{{ $board->title }}</td>

                                    <td>{{ $board->subtitle }}</td>


                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            @if($board->status == 1)
                                            <a href="{{route('admin.boards.disable', $board->id)}}" class="btn btn-sm btn-primary" style="margin:3px;"> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                            @else
                                            <a href="{{route('admin.boards.disable', $board->id)}}" class="btn btn-sm btn-danger" style="margin:3px;"> <i class="fa fa-eye-slash" aria-hidden="true"></i> </a>
                                            @endif
                                            <a href="{{ route('admin.boards.edit', $board->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            {{-- <a href="{{ route('admin.boards.delete', $board->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js')}}') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js')}}') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>



@endpush
