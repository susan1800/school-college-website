@extends('admin.app')
<style>
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  min-width: 50% !important;
  max-width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  text-align: right;
    font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
    </style>
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary pull-right">Add subject</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile table-responsive ">
                <div class="tile-body table-responsive ">
                    <table class="table table-hover table-bordered  " id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Subject </th>
                            <th>label</th>
                            <th>image</th>
                            <th>Chapter_id</th>

                            <th  class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>


                            @foreach($subjects->groupBy('program_id') as $value)
                        @foreach($value as $subject)
                            @if ($subject->id != 0)
                                <tr>
                                    <td>{{ $subject->id }} <a href="{{route('admin.subjects.copy',$subject->id)}}" style="color:white; docuration:none;"> <div style="font-size: 13px; background:#ff4800; color:white; padding:5px 10px 5px 10px; border-radius:10px; cursor:pointer;"> Copy</div> </a></td>
                                    <td>{{ $subject->subject }}
                                        <br>
                                        {{ $subject->program->program }} <br>
                                        ( {{ $subject->program->board->title }}->{{ $subject->program->board->subtitle }} )
                                    </td>


                                    <td>{{ $subject->level->title }}
                                        <br>
                                        @if ($subject->syllabus == "subject/default/syllabus.pdf")
                                        <a href="{{asset('storage/'.$subject->syllabus )}}" target="blank">D-syllabus </a>
                                        @else
                                        <a href="{{asset('storage/'.$subject->syllabus )}}" target="blank"> syllabus </a>
                                        @endif

                                        @if ($subject->qn_bank == "subject/default/qn_bank.pdf")
                                        <a href="{{asset('storage/'.$subject->qn_bank )}}" target="blank">D-QN_Bank </a>

                                        @else
                                        <a href="{{asset('storage/'.$subject->qn_bank )}}" target="blank">QN_Bank </a>
                                        @endif

                                    </td>



                                    <td><img src="{{asset('storage/'.$subject->image ) }}" height="100" width="100"></td>
                                    <td>
                                        @foreach ($subject->chapter as $chapter)
                                        {{$chapter->chapter}} ,

                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <button onclick="upload({{$subject->id}})" style="margin:3px;"><i class="fa fa-upload"></i></button>
                                            <br>
                                            @if($subject->status == 1)
                                            <a href="{{route('admin.subjects.disable',$subject->id)}}" class="btn btn-primary" style="margin:3px;"> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                            @else
                                            <a href="{{route('admin.subjects.disable',$subject->id)}}" class="btn btn-sm btn-danger" style="margin:3px;"> <i class="fa fa-eye-slash" aria-hidden="true"></i> </a>
                                            @endif
                                            <br>


                                            <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-sm btn-primary" style="margin:3px;"><i class="fa fa-edit"></i></a><br>
                                            <a onclick="deletefunction('<?= $subject->id ?>')" class="btn btn-sm btn-danger" style="margin:3px;"><i class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
    <form action="{{route('admin.subjects.upload')}}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="subjectid" name="subjectid">
        <div class="form-group">
            <label class="control-label">syllabus</label>
            <input class="form-control @error('syllabus') is-invalid @enderror" type="file" accept=".pdf" id="syllabus" name="syllabus" />
            @error('syllabus') {{ $message }} @enderror
        </div>

        <div class="form-group">
            <label class="control-label">QN Bank</label>
            <input class="form-control @error('qn_bank') is-invalid @enderror" type="file" accept=".pdf" id="qn_bank" name="qn_bank" />
            @error('qn_bank') {{ $message }} @enderror
        </div>
        <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save subject</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary close1"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
    </form>
        </div>
    </div>




@endsection


<script>
    function upload(id){
            document.getElementById("subjectid").value = id;

            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal


            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            var span1 = document.getElementsByClassName("close1")[0];

            // When the user clicks the button, open the modal

            modal.style.display = "block";


            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }
            span1.onclick = function() {
            modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            // window.onclick = function(event) {
            // if (event.target == modal) {
            //     modal.style.display = "none";
            // }
            // }
    }


    function adddetails(id){
            document.getElementById("subjectid").value = id;

            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal


            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            var span1 = document.getElementsByClassName("close1")[0];

            // When the user clicks the button, open the modal

            modal.style.display = "block";


            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }
            span1.onclick = function() {
            modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            // window.onclick = function(event) {
            // if (event.target == modal) {
            //     modal.style.display = "none";
            // }
            // }
    }

    </script>

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
  text: "this may effect on other chapter related to this !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url: "https://uttarpustika.com/admin/subjects/"+id+"/delete", success: function(result){

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
  title: 'this program has relation with chapter table data, Please delete it first !',
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
