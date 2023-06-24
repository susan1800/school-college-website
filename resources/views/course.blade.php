@include('partials.head')
@include('partials.header')

<body>


<div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url({{asset('frontend/img/breadcrumb-bg.jpg')}}) no-repeat">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-white">
        <h1 class="text-white">
            {{$targetcourse->title}}
        </h1>
            </div>
        <div class="col-md-6" style="color: white;">
            <ol class="breadcrumb justify-content-md-end bg-transparent">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item">
                   Course
                </li>
            </ol>
        </div>
        </div>

    </div>

</div>

<section class="padding-y-10">
    <div class="container col-md-11">
        <div class="row ">
            <div class="col-lg-8 align-items-center">
                <h2>
                    Course Information
                </h2>
                <div class="width-4rem height-4 bg-primary rounded mt-4 marginBottom-40"></div>
                <p class="mb-2">
                    {!! $targetcourse->details !!}
                </p>
            </div> <!-- END col-lg-6 ml-auto-->

            <div class="col-lg-4 col-md-4" style="border-left: 2px solid red; height: 100%;">
                <div style="height: 100%">
                <h3 style="height: 40px; width:100%;">Other Course</h3>
                <hr>
                @foreach($courses as $course)
                @if($course->id != $targetcourse->id)
                <div class="">
                    <a href="{{route('course',$course->id)}}" style="display: flex; col-md-12">
                    <img class="wow fadeInRight w-100 rounded col-md-4" src="{{asset('storage/'.$course->image)}}" alt="" height="100px;">
                   <div class="col-md-9">
                   <p  style=" overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 2; /* number of lines to show */
                    -webkit-box-orient: vertical;"><b>{{$course->title}}</b></p>
                    <p class="" style="color:rgb(250, 173, 7)">Read More >></p>
                    </div>
                    </a>
                </div>
                <hr>
                @endif
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
