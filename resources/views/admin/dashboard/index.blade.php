@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')

@endsection


<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
