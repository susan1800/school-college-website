@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<script>
    function checksubtitle(){
        var title = document.getElementById('title').value;
        var x = document.getElementById("subtitle");
        if(title=='tribhuvan university'){
            document.getElementById("subtitle").options.length=0;

            var option = document.createElement("option");
            option.value = "";
            option.text = "";
            x.add(option);

            var option = document.createElement("option");
            option.value = "engineering";
            option.text = "Engineering";
            x.add(option);

            var option = document.createElement("option");
            option.value = "business management";
            option.text = "Business Management";
            x.add(option);

            var option = document.createElement("option");
            option.value = "Bachelor in computer science and information technology";
            option.text = "Bachelor in Computer Science and Information Technology";
            x.add(option);

            var option = document.createElement("option");
            option.value = "science";
            option.text = "Science";
            x.add(option);

            var option = document.createElement("option");
            option.value = "information management";
            option.text = "Information Management";
            x.add(option);

            var option = document.createElement("option");
            option.value = "computer application";
            option.text = "Computer Application";
            x.add(option);

            var option = document.createElement("option");
            option.value = "business studies";
            option.text = "Business Studies";
            x.add(option);

            var option = document.createElement("option");
            option.value = "business administration";
            option.text = "Business Administration";
            x.add(option);

            var option = document.createElement("option");
            option.value = "medical laboratory technology";
            option.text = "Medical Laboratory Technology";
            x.add(option);

            var option = document.createElement("option");
            option.value = "hotel management";
            option.text = "Hotel Management";
            x.add(option);

            var option = document.createElement("option");
            option.value = "education";
            option.text = "Education";
            x.add(option);

            var option = document.createElement("option");
            option.value = "arts";
            option.text = "Arts";
            x.add(option);

            var option = document.createElement("option");
            option.value = "architecture";
            option.text = "Architecture";
            x.add(option);
        }

        else if(title=='pokhara university'){
            document.getElementById("subtitle").options.length=0;
            var option = document.createElement("option");
            option.value = "";
            option.text = "";
            x.add(option);
            var option = document.createElement("option");
            option.value = "engineering";
            option.text = "Engineering";
            x.add(option);
            var option = document.createElement("option");
            option.value = "health care management";
            option.text = "Health Care Management";
            x.add(option);
            var option = document.createElement("option");
            option.value = "Architecture";
            option.text = "Architecture";
            x.add(option);

            var option = document.createElement("option");
            option.value = "computer information system";
            option.text = "Computer Information System";
            x.add(option);

            var option = document.createElement("option");
            option.value = "business administration";
            option.text = "Business Administration";
            x.add(option);

            var option = document.createElement("option");
            option.value = "public health";
            option.text = "Public Health";
            x.add(option);

            var option = document.createElement("option");
            option.value = "hotel management";
            option.text = "Hotel Management";
            x.add(option);

            var option = document.createElement("option");
            option.value = "health care management";
            option.text = "Health Care Management";
            x.add(option);

            var option = document.createElement("option");
            option.value = "science";
            option.text = "Science";
            x.add(option);

            var option = document.createElement("option");
            option.value = "computer application";
            option.text = "Computer Application";
            x.add(option);

            var option = document.createElement("option");
            option.value = "arts";
            option.text = "Arts";
            x.add(option);

            var option = document.createElement("option");
            option.value = "laws";
            option.text = "Laws";
            x.add(option);


        }
        else if(title=='purbanchal university'){
            document.getElementById("subtitle").options.length=0;
            var option = document.createElement("option");
            option.value = "";
            option.text = "";
            x.add(option);
            var option = document.createElement("option");
            option.value = "engineering";
            option.text = "Engineering";
            x.add(option);
            var option = document.createElement("option");
            option.value = "business administration";
            option.text = "Business Administration";
            x.add(option);
            var option = document.createElement("option");
            option.value = "architecture";
            option.text = "Architecture";
            x.add(option);

            var option = document.createElement("option");
            option.value = "hotel management";
            option.text = "Hotel Management";
            x.add(option);

            var option = document.createElement("option");
            option.value = "homeopathic medicine and surgery";
            option.text = "Homeopathic Medicine and Surgery";
            x.add(option);

            var option = document.createElement("option");
            option.value = "media technology";
            option.text = "Media Technology";
            x.add(option);

            var option = document.createElement("option");
            option.value = "science";
            option.text = "Science";
            x.add(option);

            var option = document.createElement("option");
            option.value = "pharmacy";
            option.text = "Pharmacy";
            x.add(option);

            var option = document.createElement("option");
            option.value = "fashion design and management";
            option.text = "Fashion Design and Management";
            x.add(option);

        }
        else if(title=='kathmandu university'){
            document.getElementById("subtitle").options.length=0;
            var option = document.createElement("option");
            option.value = "";
            option.text = "";
            x.add(option);

            var option = document.createElement("option");
            option.value = "engineering";
            option.text = "Engineering";
            x.add(option);

            var option = document.createElement("option");
            option.value = "business management";
            option.text = "Business Management";
            x.add(option);

            var option = document.createElement("option");
            option.value = "technical education";
            option.text = "Technical Education";
            x.add(option);

            var option = document.createElement("option");
            option.value = "law";
            option.text = "Law";
            x.add(option);

            var option = document.createElement("option");
            option.value = "business administration";
            option.text = "Business Administration";
            x.add(option);

            var option = document.createElement("option");
            option.value = "professional hospitality";
            option.text = "Professional Hospitality";
            x.add(option);

            var option = document.createElement("option");
            option.value = "social work";
            option.text = "Social Work";
            x.add(option);

            var option = document.createElement("option");
            option.value = "physiotherapy";
            option.text = "physiotherapy";
            x.add(option);

            var option = document.createElement("option");
            option.value = "fine arts";
            option.text = "Fine Arts";
            x.add(option);

            var option = document.createElement("option");
            option.value = "media studies";
            option.text = "Media Studies";
            x.add(option);

            var option = document.createElement("option");
            option.value = "science";
            option.text = "Science";
            x.add(option);

            var option = document.createElement("option");
            option.value = "economics";
            option.text = "Economics";
            x.add(option);
            var option = document.createElement("option");
            option.value = "architecture";
            option.text = "Architecture";
            x.add(option);
        }

        else if(title=='pokhara university'){
            document.getElementById("subtitle").options.length=0;
            var option = document.createElement("option");
            option.value = "";
            option.text = "";
            x.add(option);
            var option = document.createElement("option");
            option.value = "engineering";
            option.text = "Engineering";
            x.add(option);
            var option = document.createElement("option");
            option.value = "BBS";
            option.text = "BBS";
            x.add(option);
            var option = document.createElement("option");
            option.value = "Architecture";
            option.text = "Architecture";
            x.add(option);
            var option = document.createElement("option");
            option.value = "BBA";
            option.text = "BBA";
            x.add(option);



        }
        else if(title=='neb'){
            document.getElementById("subtitle").options.length=0;
            var option = document.createElement("option");
            option.value = "";
            option.text = "";
            x.add(option);


        }
        else if(title=='school'){
            document.getElementById("subtitle").options.length=0;
            var option = document.createElement("option");
            option.value = "";
            option.text = "";


        }
        else{
            document.getElementById("subtitle").options.length=0;
            var option = document.createElement("option");
            option.value = "";
            option.text = "select subtitle";
            x.add(option);
        }
    }
</script>
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
                <form action="{{ route('admin.boards.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <select id=title class="form-control custom-select mt-15 @error('title') is-invalid @enderror" name="title" onchange="checksubtitle();">
                                <option value="">select title</option>
                                <option value="tribhuvan university">Tribhuvan University</option>
                                <option value="pokhara university">Pokhara University</option>
                                <option value="purbanchal university">Purbanchal University</option>
                                <option value="kathmandu university">Kathmandu University</option>
                                <option value="neb">NEB</option>
                                <option value="school">School</option>
                            @error('title') {{ $message }} @enderror
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="subtitle">subtitle <span class="m-l-5 text-danger"> *</span></label>
                            <select id=subtitle class="form-control custom-select mt-15 @error('subtitle') is-invalid @enderror" name="subtitle" >
                                <option value="">select subtitle</option>

                            @error('title') {{ $message }} @enderror
                            </select>
                        </div>



                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Author</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.boards.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
