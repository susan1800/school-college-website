@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>

    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile table-responsive">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> name </th>
                            <th>Email</th>
                            <th>phone</th>
                            <th>message</th>
                            {{-- <th  class="text-center text-danger"><i class="fa fa-bolt"> </i></th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                        @foreach($contacts as $contact)
                            @if ($contact->id != 0)
                                <tr>
                                    <td>{{ $i }}</td>

                                    <td>{{ $contact->name }}</td>

                                    <td> {{ $contact->email }} </td>
                                    <td> {{ $contact->phone }} </td>
                                    <td>{{ $contact->message }}</td>
                                    {{-- <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a onclick="deletefunction(<?= $contact->id ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td> --}}
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
    function deletefunction(id){

Swal.fire({
  title: 'Are you sure to delete?',
  text: "this may effect on Pdf related to this !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url: "https://uttarpustika.com/admin/contacts/"+id+"/delete", success: function(result){

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
  title: 'this program has relation with other table please remove it first !',
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
