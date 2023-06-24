@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.scholarships.create') }}" class="btn btn-primary pull-right">Add scholarship</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Title </th>
                            <th> Quota </th>
                            <th> waive </th>
                            <th> Eligiblity </th>
                            <th> Remarks</th>
                            <th class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($scholarships as $scholarship)
                            @if ($scholarship->id != 0)
                                <tr>
                                    <td>{{ $scholarship->id }}</td>
                                    <td>{{ $scholarship->title }}</td>
                                    <td>{{ $scholarship->quota }}</td>
                                    <td>{{ $scholarship->waive}}</td>
                                    <td>{{ $scholarship->eligibility}}</td>
                                    <td>{{ $scholarship->remarks }}</td>


                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            @if($scholarship->status == 1)
                                            <a href="{{ route('admin.scholarships.disable', $scholarship->id) }}" class="btn btn-sm btn-primary" style="margin:3px;"> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                            @else
                                            <a href="{{ route('admin.scholarships.disable', $scholarship->id) }}" class="btn btn-sm btn-danger" style="margin:3px;"> <i class="fa fa-eye-slash" aria-hidden="true"></i> </a>
                                            @endif
                                            <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick="deletefunction('<?= $scholarship->id ?>','{{ env('MAIN_URL') }}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
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





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    function deletefunction(id,url){

Swal.fire({
  title: 'Are you sure to delete?',
  text: "this may effect on other chapter related to this !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url: url+"/admin/scholarships/"+id+"/delete", success: function(result){

        if(result == "success"){
        Swal.fire({
  title: 'Deleted successfully !',
  icon: 'success',
  confirmButtonColor: '#3085d6',
  confirmButtonText: 'Ok'
}).then((result1) => {
  if (result1.isConfirmed) {
        location.reload();
  }
});
}
if(result == "reletion error"){

    Swal.fire({
  title: 'this program has relation other table data, Please delete it first !',
  icon: 'error',
  confirmButtonColor: '#3085d6',
  confirmButtonText: 'Ok'
}).then((result1) => {
  if (result1.isConfirmed) {

  }
});
}
if(result == "error"){

Swal.fire({
title: 'Something getting wrong please try again !',
icon: 'error',
confirmButtonColor: '#3085d6',
confirmButtonText: 'Ok'
}).then((result) => {
if (result.isConfirmed) {

}
});
}

  }});
  }
})
    }
</script>
