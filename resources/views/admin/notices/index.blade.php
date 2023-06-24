@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.notices.create') }}" class="btn btn-primary pull-right">Add notice</a>
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
                            <th> title </th>
                            <th>file</th>
                            <th class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                        @endphp
                        @foreach($notices as $notice)
                            @if ($notice->id != 0)
                                <tr>
                                    <td>{{ $i }} </td>


                                    <td>{{ $notice->title }}


                                    </td>

                                    <td>
                                        <a target="blank" href="{{ asset('storage/'.$notice->file) }}" class="btn btn-primary"> View File</a>
                                    </td>

                                    <td class="text-center">

                                            @if($notice->status == 1)
                                            <a href="{{route('admin.notices.disable',$notice->id)}}" class="btn btn-primary"> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                            @else
                                            <a href="{{route('admin.notices.disable',$notice->id)}}" class="btn btn-sm btn-danger"> <i class="fa fa-eye-slash" aria-hidden="true"></i> </a>
                                            @endif

                                            <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a  class="btn btn-sm btn-danger" onclick="deletefunction('<?= $notice->id ?>','{{ env('MAIN_URL') }}')"><i class="fa fa-trash"></i></a>
                                            <a href="{{ route('admin.notices.delete', $notice->id) }}" style="display:none;" id="deleteid"></a>

                                    </td>
                                </tr>
                                @php
                                $i++;
                            @endphp
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
  text: "this may effect on other subject and chapter related to this !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url: url+"/admin/notices/"+id+"/delete", success: function(result){

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
  title: 'this notice has relation in level and subject table data, Please delete it first !',
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
