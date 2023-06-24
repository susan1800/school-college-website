@include('partials.head')
@include('partials.header')
<body>

<div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url({{asset('frontend/img/breadcrumb-bg.jpg')}}) no-repeat">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-md-6 text-white">
                <h2> Life At Advance Academy</h2>
            </div>
            <div class="col-md-6" style="color: white;">
                <ol class="breadcrumb justify-content-md-end bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{route('index')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                       Life At Advance Academy
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>


<script src="js/jquery.fancybox.min.js"></script>
<script src="js/main.js"></script>






<section class="col-md-12" >
    <div class="col-md-12">
        <div class="row">
            <div class="col-12 text-center mb-md-4">
                <h2 class="mb-4">
                    Life At Advance Academy
                </h2>
                <div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
            </div>
        </div> <!-- END row-->
        <div class="row">
            <div class="container-fluid photos">
                <div class="row align-items-stretch">
                    @foreach ($lifes as $life)


                <div class="" data-aos="fade-up" style="padding:3px;">
                <a href="{{asset('storage/'.$life->image)}}" class="d-block photo-item" data-fancybox="gallery">
                <img src="{{asset('storage/'.$life->image)}}" alt="Image" class="img-fluid" style="height:300px;">
                <div class="photo-text-more">
                <span class="icon icon-search"></span>
                </div>
                </a>
                </div>
                @endforeach
                </div>
                </div>


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


@include('partials.footer')
