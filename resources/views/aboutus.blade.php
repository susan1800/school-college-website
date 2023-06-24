@include('partials.head')
@include('partials.header')

<div class="col-sm-12">

    </div>

<body>
<div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url(frontend/img/breadcrumb-bg.jpg) no-repeat">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-white">
                <h2>About Us</h2>
            </div>
            <div class="col-md-6" style="color:white;">
                <ol class="breadcrumb justify-content-md-end bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{route('about')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        About Us
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>






<section class="padding-y-100 bg-light-v4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card padding-30 shadow-v1 marginTop-30">

                    <div class="mb-5">

                        {!! $about->details !!}
                    </div>
                    <!--<ul class="list-inline">
                        <li class="list-inline-item">Share on :</li>
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-facebook iconbox iconbox-sm"><i class="ti-facebook"></i></a>
                            <a href="#" class="btn btn-twitter iconbox iconbox-sm"><i class="ti-twitter"></i></a>
                            <a href="#" class="btn btn-google-plus iconbox iconbox-sm"><i class="ti-google"></i></a>
                        </li>
                    </ul>-->
                </div>
            </div>




{{--
            <div class="col-lg-3 col-md-4">
                <div class="card padding-30 shadow-v1  marginTop-30">
                    <h4 class="mb-3">College Features</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt mr-1"></i> <span class="font-weight-semiBold">Location:</span> <br>
                            Chapagaun Dobato, Tutepani
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-briefcase mr-1"></i> <span class="font-weight-semiBold">Study Type:</span> <br>
                            Full time
                        </li>
                        <!--<li class="mb-3">
                            <i class="fas fa-dollar-sign mr-1"></i> <span class="font-weight-semiBold">Cost: </span> <br>
                            4 Lakh Onwards
                        </li>-->
                        <li class="mb-3">
                            <i class="fas fa-graduation-cap"></i> <span class="font-weight-semiBold">Education:</span> <br>
                            class one to bachelor
                        </li>
                        {{-- <li class="mb-3">
                            <i class="fas fa-flask mr-1"></i> <span class="font-weight-semiBold">Experience:</span> <br>
                            Not required
                        </li> --}}
                    {{-- </ul>
                </div>
                <div class="card padding-30 shadow-v1  marginTop-30">
                    <h4 class="mb-3">College Info</h4>
                    <ul class="list-unstyled">

                        <li>
                            <span class="font-weight-semiBold">Address:</span> Chapagaun Dobato
                        </li>
                        <li>
                            <span class="font-weight-semiBold">College Size:</span>  120+ Employee
                        </li>
                        <li>
                            <span class="font-weight-semiBold">University:</span> <a href="#">Pokhara University</a>
                        </li>
                        <li>
                            <span class="font-weight-semiBold">Phone:</span> +97715151411
                        </li>
                        <li>
                            <span class="font-weight-semiBold">Email:</span> <a href="#">info@cosmoscollege.edu.np</a>
                        </li>
                        <li>
                            <span class="font-weight-semiBold">Website:</span> <a href="#">www.cosmoscollege.edu.np</a>
                        </li>
                    </ul> --}}

                   <!-- <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-facebook iconbox iconbox-xs">
                                <i class="ti-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-twitter iconbox iconbox-xs">
                                <i class="ti-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-linkedin iconbox iconbox-xs">
                                <i class="ti-linkedin"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-google-plus iconbox iconbox-xs">
                                <i class="ti-google"></i>
                            </a>
                        </li>
                    </ul>-->
                {{-- </div>
            </div> --}}
        </div> <!-- END row-->
    </div> <!-- END container-->
</section>






<section class="padding-y-120">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>
                    Our Course
                </h2>
                <div class="width-3rem height-4 rounded bg-primary mx-auto mb-4"></div>
                <p class="mt-5">
                    Following list displays our current programs.
                </p>
            </div>
            <div class="col-12 mt-5">

                <div class="shadow-v3 rounded">

                    <div class="list-card align-items-center px-4 padding-y-30 border-bottom border-light">
                        <div class="col-md-6">
                            <h4>pre school</h4>
                            <ul class="list-inline mb-0">

                                <li class="list-inline-item mr-3 mt-2"><i class="fas fa-map-marker-alt"></i> kumaripati, Lalitpur</li>

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mr-3 mt-2"><span class="badge badge-pill badge-success">10:00 AM - 4:00 PM</span></li>

                            </ul>
                        </div>

                    </div>

                    <div class="list-card align-items-center px-4 padding-y-30 border-bottom border-light">
                        <div class="col-md-6">
                            <h4>+2 Science</h4>
                            <ul class="list-inline mb-0">

                                <li class="list-inline-item mr-3 mt-2"><i class="fas fa-map-marker-alt"></i> kumaripati, Lalitpur</li>

                            </ul>

                        </div>
                        <div class="col-md-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mr-3 mt-2"><span class="badge badge-pill badge-warning">11:00 AM - 5:00 PM</span></li>

                            </ul>
                        </div>

                    </div>

                    <div class="list-card align-items-center px-4 padding-y-30 border-bottom border-light">
                        <div class="col-md-6">
                            <h4>+2 Management</h4>
                            <ul class="list-inline mb-0">

                                <li class="list-inline-item mr-3 mt-2"><i class="fas fa-map-marker-alt"></i> kumaripati, Lalitpur</li>

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mr-3 mt-2"><span class="badge badge-pill badge-info">6:30 AM - 10:45 AM</span></li>
                                <li class="list-inline-item mr-3 mt-2"><span class="badge badge-pill badge-info">11:00 AM - 3:15 PM</span></li>

                            </ul>
                        </div>

                    </div>




                    <div class="list-card align-items-center px-4 padding-y-30 border-bottom border-light">
                        <div class="col-md-6">
                            <h4>+2 Humanities</h4>
                            <ul class="list-inline mb-0">

                                <li class="list-inline-item mr-3 mt-2"><i class="fas fa-map-marker-alt"></i> kumaripati, Lalitpur</li>

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mr-3 mt-2"><span class="badge badge-pill badge-success">6:30 AM - 10:45 AM</span></li>
                                <li class="list-inline-item mr-3 mt-2"><span class="badge badge-pill badge-success">11:00 AM - 3:15 PM</span></li>

                            </ul>
                        </div>

                    </div>

                    <div class="list-card align-items-center px-4 padding-y-30 border-bottom border-light">
                        <div class="col-md-6">
                            <h4>Bachelor (BBS)</h4>
                            <ul class="list-inline mb-0">

                                <li class="list-inline-item mr-3 mt-2"><i class="fas fa-map-marker-alt"></i> kumaripati, Lalitpur</li>

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mr-3 mt-2"><span class="badge badge-pill  btn-secondary">6:00 AM - 9:40 AM</span></li>

                            </ul>
                        </div>


                    </div>




                </div>
            </div>
        </div> <!-- END row-->
    </div> <!-- END container-->
</section>


{{--
<section class="padding-y-120">
    <div class="container">
        <!-- Success message -->
            </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto text-center">
                            </div>
            <div class="col-lg-6 mx-auto text-center">
                <h2 style="font-family: Maven Pro">
                    Apply For Bachelors
                </h2>
                <div class="width-3rem height-4 rounded bg-primary mx-auto mb-4"></div>
            </div>

            <div class="card">
                <div class="col-lg-9 mx-auto mt-5">
                    <form class="row" action="https://cosmoscollege.edu.np/contacts" method="POST">
                        <input type="hidden" name="_token" value="EU8A4XQN4RJKJtVeSjtQpVJA6jv7vwTAXqctnodq">
                        <div class="col-md-12 mb-4">
                            <input type="text" class="form-control rounded-2" required name="name" placeholder="Full Name" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <input type="email" class="form-control rounded-pill" name="email" placeholder="Email" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <input type="number" class="form-control rounded-pill" required name="phone_number" maxlength="10" placeholder="Phone">
                        </div>

                        <div class="col-md-6 mb-4">
                            <input type="text" class="form-control rounded-pill" name="slcmarks" placeholder="Marks in SLC">
                        </div>

                        <div class="col-md-6 mb-4">
                            <input type="text" class="form-control rounded-pill" name="elevenmarks" placeholder="Marks in Grade 11">
                        </div>

                        <div class="col-md-6 mb-4">
                            <input type="text" class="form-control rounded-pill" name="twelvemarks" placeholder="HSEB/A Levels">
                        </div>

                        <div class="col-md-6 mb-4">
                            <input type="text" name="slcschool" class="form-control rounded-pill" placeholder="School Name">
                        </div>

                        <div class="col-md-12 mb-4">
                            <input type="text" name="elevenschool" class="form-control rounded-pill" placeholder="Higher School Name">
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="interest">Select Program</label> <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="program[]" id="inlineCheckbox1" value="bba">
                                <label class="form-check-label" for="inlineCheckbox1">BBA</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="program[]" id="inlineCheckbox2" value="beit">
                                <label class="form-check-label" for="inlineCheckbox2">BEIT</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="program[]" id="inlineCheckbox3" value="computer">
                                <label class="form-check-label" for="inlineCheckbox3">BE Computer</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="bex">
                                <label class="form-check-label" for="inlineCheckbox4">BE Elx & Communication</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="program[]" id="inlineCheckbox5" value="civil">
                                <label class="form-check-label" for="inlineCheckbox5">BE Civil</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="program[]" id="inlineCheckbox6" value="architecture">
                                <label class="form-check-label" for="inlineCheckbox6">Architecture</label>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <textarea type="text" class="form-control rounded-pill" rows="5" name="enquiry" placeholder="Any Enquires"></textarea>
                        </div>
                        <div class="col-12 mb-5 text-center">
                            <button class="btn btn-primary">Submit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- END row-->
    </div>
</section> --}}
@include('partials.footer')
