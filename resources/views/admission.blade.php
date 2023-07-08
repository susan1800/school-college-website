@include('partials.head')
@include('partials.header')


<div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url({{asset('frontend/img/breadcrumb-bg.jpg')}}) no-repeat">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-md-6 text-white">
                <h2> Admission Form</h2>
            </div>
            <div class="col-md-6" style="color: white;">
                <ol class="breadcrumb justify-content-md-end bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{route('index')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                       Admission Form
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="py-5 shadow-v2 position-relative" style="background:rgb(180, 178, 178);">
    <div class="container">

<div class="row">
    <div class="col-md-8 mx-auto" style="background:white;  border-radius:20px; padding-top:30px;padding-bottom:30px;">
        <div class="tile">
            <h5 class="tile-title">Come, join us for a better future. Together today for a successful tomorrow.

            </h5>
            @include('admin.partials.flash')
            <div class="width-5rem height-4 rounded bg-primary mx-auto"></div>
            <br><br>
            <form action="{{ route('admission.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="tile-body">
                    <div class="form-group col-md-12">
                        <label class="control-label" for="name">Applicant Full Name <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="your full name"/>
                        @error('name') {{ $message }} @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label" for="gender">Gender <span class="m-l-5 text-danger"> *</span></label>
                        <select  class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                            <option value="o">Other</option>

                        </select>

                        @error('gender') {{ $message }} @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label" for="course">course <span class="m-l-5 text-danger"> *</span></label>
                        <select  class="form-control @error('course') is-invalid @enderror" name="course" id="course" onchange="showoption()">
                            <option value="">Select Course</option>
                            <option value="school" @if(old('course') == 'school') selected @endif>Pre-School</option>
                            <option value="science" @if(old('course') == 'science') selected @endif>+2 Science</option>
                            <option value="management" @if(old('course') == 'management') selected @endif>+2 Management</option>
                            <option value="humanities" @if(old('course') == 'humanities') selected @endif>+2 Humanities</option>
                            <option value="bbs" @if(old('course') == 'bbs') selected @endif>BBS</option>

                        </select>

                        @error('course') {{ $message }} @enderror
                    </div>


                    <div id="see" style="display:none;">
                    <div class="form-group col-md-12">
                        <label class="control-label" for="see_grade">SEE Grade <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('see_grade') is-invalid @enderror" type="text" name="see_grade" id="see_grade" value="{{ old('see_grade') }}" placeholder="Eg:3.15(B+)"/>
                        @error('see_grade') {{ $message }} @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label" for="school_name">School Name <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('school_name') is-invalid @enderror" type="text" name="school_name" id="school_name" value="{{ old('school_name') }}" placeholder="School name"/>
                        @error('school_name') {{ $message }} @enderror
                    </div>
                </div>

                <div id="neb" style="display:none;">
                    <div class="form-group col-md-12">
                        <label class="control-label" for="neb_grade">+2 Grade <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('neb_grade') is-invalid @enderror" type="text" name="neb_grade" id="neb_grade" value="{{ old('neb_grade') }}" placeholder="Eg:3.15(B+)"/>
                        @error('neb_grade') {{ $message }} @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label" for="neb_school_name">+2 School Name <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('neb_school_name') is-invalid @enderror" type="text" name="neb_school_name" id="neb_school_name" value="{{ old('neb_school_name') }}" placeholder="School name"/>
                        @error('neb_school_name') {{ $message }} @enderror
                    </div>
                </div>


                <script>
                    showoption();
                    function showoption(){

                        value= document.getElementById('course');

                        if((value.value == "science") || (value.value == "management") || (value.value == "humanities")){
                            document.getElementById('see').style.display = 'block';
                            document.getElementById('neb').style.display = 'none';
                        }
                        if(value.value == "bbs"){

                            document.getElementById('see').style.display = 'block';
                            document.getElementById('neb').style.display = 'block';
                        }
                        if((value.value == "school")){
                            document.getElementById('see').style.display = 'none';
                            document.getElementById('neb').style.display = 'none';
                        }

                    }
                </script>




                    <div class="form-group col-md-12">
                        <label class="control-label" for="birthday">Applicant Birthday <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('birthday') is-invalid @enderror" type="date" name="birthday" id="birthday" value="{{ old('birthday') }}"/>
                        @error('birthday') {{ $message }} @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label" for="nationality">Applicant Nationality <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('nationality') is-invalid @enderror" type="text" name="nationality" id="nationality" value="{{ old('nationality') }}" placeholder="Eg:Nepali"/>
                        @error('nationality') {{ $message }} @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label" for="mobile">Applicant mobile number <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('mobile') is-invalid @enderror" type="number" name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="your mobile number"/>
                        @error('mobile') {{ $message }} @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label" for="father_name">Father name <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('father_name') is-invalid @enderror" type="text" name="father_name" id="father_name" value="{{ old('father_name') }}" placeholder="your father name"/>
                        @error('father_name') {{ $message }} @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label" for="father_number">Father number <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('father_number') is-invalid @enderror" type="number" name="father_number" id="father_number" value="{{ old('father_number') }}" placeholder="your father mobile number"/>
                        @error('father_number') {{ $message }} @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Applicant Photo <span class="m-l-5 text-danger"> *</span> </label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                        @error('image') {{ $message }} @enderror
                    </div>


                    <div class="form-group col-md-12">
                        <label class="control-label" for="query">Write your query(if any)</label>
                        <textarea class="form-control @error('query') is-invalid @enderror " rows="4" name="query" id="query">{{ old('query') }}</textarea>
                        @error('query') {{ $message }} @enderror
                    </div>






                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit Form</button>

                </div>
            </form>
        </div>
    </div>
</div>
    </div>
</section>

@include('partials.footer')
