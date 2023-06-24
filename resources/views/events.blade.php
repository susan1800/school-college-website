@include('partials.head')
@include('partials.header')
<body>

    <div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url({{asset('frontend/img/breadcrumb-bg.jpg')}}) no-repeat">
        <div class="container" >
            <div class="row align-items-center">
                <div class="col-md-6 text-white">
                    <h2> Event</h2>
                </div>
                <div class="col-md-6" style="color: white;">
                    <ol class="breadcrumb justify-content-md-end bg-transparent">
                        <li class="breadcrumb-item">
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                           Event
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



<section class="padding-y-60 bg-light">
    <div class="container">

        <div class="row">

            @foreach($events as $event)
                    <div class="col-lg-4 col-md-6 marginTop-30">
                        <div class="card height-100p shadow-v1">
                                                        <img class="card-img-top" src="frontend/img/banneradmission.html" alt="">
                                                        <div class="card-body">
                                <a href="{{route('single.event',$event->id)}}" class="h4">
                                    {{$event->title}}
                                </a>
                                <ul class="list-unstyled line-height-lg mt-4">
                                    <li><i class="ti-calendar text-primary mr-2"></i>{{$event->date}}</li>
                                    <li><i class="ti-location-pin text-primary mr-2"></i>{{$event->location}}</li>
                                </ul>
                                <a href="{{route('single.event',$event->id)}}" class="btn btn-link pl-0">View Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach


        </div> <!-- END row-->

    </div> <!-- END container-->
</section>

@include('partials.footer')

<div class="scroll-top">
    <i class="ti-angle-up"></i>
</div>

<script src="frontend/js/vendors.bundle.js"></script>
<script src="frontend/js/scripts.js"></script>
</body>
