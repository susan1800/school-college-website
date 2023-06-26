
@include('partials.head')


@include('partials.header')


<style>
        .text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1; /* number of lines to show */
            -webkit-box-orient: vertical;
        }
    </style>

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
/* Make the image fully responsive */
.carousel-inner img {
  width: 100%;
  height: 550px;
  object-fit: cover;
}
</style>

<body>
    <section class="height-90vh py-5">
    <div id="carouselExampleIndicator" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            @php
                $i=0;
            @endphp
            @foreach ($sliders as $slider)
            <li data-target="#carouselExampleIndicator" data-slide-to="{{$i}}" class="@if($i==0)active @endif" style="background:white;"></li>
            @php
                $i++;
            @endphp
            @endforeach


          {{-- <li data-target="#carouselExampleIndicator" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicator" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicator" data-slide-to="2"></li> --}}
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            @php
            $j=0;
        @endphp
            @foreach ($sliders as $slider)
          <div class="carousel-item @if($j==1) active @endif ">
            <img src="{{asset('storage/'.$slider->image)}}"  alt=""  >
          </div>
          @php
                $j++;
            @endphp
          @endforeach

        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#carouselExampleIndicator" data-slide="prev" style="">
            <div style="background:rgb(77, 76, 76); padding:10px; border-radius:30px;">
                <span class="carousel-control-prev-icon" style="color:white;"></span>
            </div>

        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicator" data-slide="next">
            <div style="background:rgb(77, 76, 76); padding:10px; border-radius:30px;">
          <span class="carousel-control-next-icon" style="color:white;"></span>
            </div>
        </a>
      </div>



</section>

<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row align-items-center">
                    <div class="col-md-6 my-5">
                        <div class="position-relative">
                            <img class="img-rounded" src="{{asset('storage/'.$about->image)}}" style="border-radius:5px;" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <h2>
                            <small class="d-block text-gray">Welcome to</small>
                            <span class="text-primary">Advance Academy </span>
                        </h2>
                        <div class="my-4" style="overflow: hidden;
                        text-overflow: ellipsis;
                        display: -webkit-box;
                        -webkit-line-clamp: 10; /* number of lines to show */
                        -webkit-box-orient: vertical;">
                            {!! $about->details !!}
                        </div>
                        <a href="{{route('about')}}" class="btn btn-outline-primary">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-5 mt-md-0" style="height: 180px; padding-top:90px;">
                <div class="card shadow-v2 z-index-5" data-offset-top-xl="-160">
                    <div class="card-header bg-primary text-white border-bottom-0">
              <span class="lead font-semiBold text-uppercase">
                Notice Board
              </span>
                    </div>

                    @foreach ($notices as $notice)
                        <div class="p-4 border-bottom wow fadeInUp">
                            <a href="{{asset('storage/'.$notice->file)}}" download>
                            <p class="text-primary mb-1">
                                {{ $notice->created_at->format('M-d-Y') }}
                            </p>
                            <p style="margin-bottom:-20px; overflow: hidden;
                            text-overflow: ellipsis;
                            display: -webkit-box;
                            -webkit-line-clamp: 2; /* number of lines to show */
                            -webkit-box-orient: vertical;">{{$notice->title}}</p>

                            </a>
                        </div>
                        @endforeach

                                        <div class="p-4">
                        <a href="{{route('notice')}}" class="btn btn-link pl-0">
                            View All Notices
                        </a>
                    </div>
                </div>
            </div>
        </div> <!-- END row-->
    </div> <!-- END container-->
</section>

<section class="padding-y-100 bg-light-v5">

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-md-4">
                <h2 class="mb-4">
                    Course Available
                </h2>
                <div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
            </div>
            @php
                $i=1;
            @endphp
            @foreach ($courses as $course)


            <div class="col-lg-4 col-md-7 marginTop-30">
                <a href="{{route('course',$course->id)}}" class="card text-white height-100p hover:parent">
                    <img class="hover:zoomin transition-0_3" src="{{asset('storage/'.$course->image)}}" alt="" height="350px;">
                    <div class="card-img-overlay bg-black-0_5 flex-center">
                        <h4>
                            {{$course->title}}
                        </h4>
                        <button class="btn @if($i==1) btn-primary @elseif($i==2) btn-success @elseif($i==3) btn-warning @else btn-primary @endif btn-sm btn-pill">
                            Read More
                        </button>
                    </div>
                </a>
            </div>
            @php
                $i++;
            @endphp
            @endforeach

        </div> <!-- END row-->
    </div>
    </div>
</section>



<section class=" paddingTop-80 paddingBottom-100">
    <div class="container">
        <div class="row text-center">


                <div class="col-md-2 col-lg-4 marginTop-30 " >
                    <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop" style="  box-shadow: 2px 2px #bdbcbc; border-radius:10px;">
                        <img src="{{asset('frontend/img/svg/4.png')}}" alt="">
                        <h4 class="mt-2">
                            Events and Personal Development
                        </h4>
                    </a>
                </div>


                <div class="col-md-6 col-lg-4 marginTop-30">
                    <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop" style="  box-shadow: 2px 2px #bdbcbc; border-radius:10px;">
                        <img src="{{asset('frontend/img/svg/5.png')}}" alt="">
                        <h4 class="mt-2">
                            Sports and Extra Curricular Activities
                        </h4>
                    </a>
                </div>


                <div class="col-md-6 col-lg-4 marginTop-30" >
                    <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop" style=" box-shadow: 2px 2px #bdbcbc; border-radius:10px;">
                        <img src="{{asset('frontend/img/svg/6.png')}}" alt="">
                        <h4 class="mt-2">
                            Best Environment to Groom
                        </h4>
                    </a>
                </div>
                    </div>
    </div>
</section>

<section class="padding-y-100 bg-light-v5">
    <div class="container">
        <div class="row">

            <div class="col-12 text-center mb-4">
                <h2 class="mb-4">
                    Upcoming Events
                </h2>
                <div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
            </div>
        </div> <!-- END row-->

        <div class="row">

            @php
use Carbon\Carbon;
@endphp
                        @foreach($events as $event)

                            <div class="col-lg-4 col-md-6 marginTop-30 wow fadeIn" data-wow-delay=".1s">
                    <div class="card shadow-v1">
                        <div class="padding-10 border-bottom">
                            <a href="{{route('single.event',$event->id)}}" class="h6 text">
                            {{$event->title}}
                            </a>
                        </div>
                        <ul class="list-unstyled padding-x-10 py-4 line-height-xl">
                            <li>
                                <i class="ti-calendar mr-2 text-primary"></i>
                                {{date('M-d-Y', strtotime($event->date))}}
                                 {{-- {{ $event->date->format('M-d-Y') }} --}}
                            </li>
                            <li>
                                <i class="ti-time mr-2 text-primary"></i>
                                {{ Carbon::parse($event->time)->format('h:i A') }}

                            </li>
                            <li>
                                <i class="ti-location-pin mr-2 text-primary"></i>
                                {{$event->location}}
                            </li>
                        </ul>
                    </div>
                </div>

                @endforeach

                        </div>
            </div>
            </section>



<style>

/* company icon slider */
.brands {
    width: 100%;
    padding-top: 90px;
    padding-bottom: 90px;
    background: #f2f2f3;
}

.brands_slider_container {
    height: 190px;
    border: solid 1px #e8e8e8;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    padding-left: 10px;
    padding-right: 10px;
    background: #fff;
}

.brands_slider {
    height: 100%;
    margin-top: 50px
}

.brands_item {
    height: 100%
}

.brands_item img {
    max-width: 100%
}

.brands_nav {
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    padding: 5px;
    cursor: pointer
}

.brands_nav i {
    color: #e5e5e5;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease
}

.brands_nav:hover i {
    color: #676767
}

</style>


<script>
        $(document).ready(function(){

if($('.brands_slider').length)
{
 var brandsSlider = $('.brands_slider');

 brandsSlider.owlCarousel(
 {
     loop:true,
     autoplay:true,
     autoplayTimeout:3000,
     nav:false,
     dots:false,
     autoWidth:true,
     items:10,
     margin:42
 });

 if($('.brands_prev').length)
 {
     var prev = $('.brands_prev');
     prev.on('click', function()
     {
         brandsSlider.trigger('prev.owl.carousel');
     });
 }

 if($('.brands_next').length)
 {
     var next = $('.brands_next');
     next.on('click', function()
     {
         brandsSlider.trigger('next.owl.carousel');
     });
 }
}


});
</script>


<section class="padding-y-100 wow fadeIn" style="background:#8299c5; box-shadow: 0px 0px 5px 5px #b7c3da;
">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h4>
                    Achievers  <span class="text-primary"></span>
                </h4>
                <p class="col-md-8" style="text-align: center; padding:auto; margin:auto;  text-align: justify;">
                    We Prove What We Claim’ has become obvious as many of our students have not only achieved their expected goals but also have presented themselves as a strong competent in global career milieu.
                    <a href="{{route('achievement')}}" style="color:blue; padding-left:10px;">View All ></a></p>
            </div>
        </div>

        <div class="row">
            <div class="col flex">
                <div class="col-md-12" style="display: flex;">
                    <div class="owl-carousel owl-theme brands_slider" style="width:95%">

                        @foreach ($achievers as $achiever)


                        <div class="owl-item" style="padding:0px; margin:0px;">
                            <div class="brands_item d-flex flex-column justify-content-center" >
                                <img src="{{asset('storage/'.$achiever->image)}}" alt="" style="height:100px; width:auto;">
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="brands_next " style="width:5%; height:30px; margin-top:70px; margin-left:5px;"><div style="width:20px; padding:5px; background:white; border-radius:50%; cursor: pointer; color:black;"> > </div></div>

                </div>
            </div>
        </div> <!-- END row-->

    </div> <!-- END container-->
</section>










    <script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>




<section class="col-md-12">
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

<section class="marginTop-100 wow fadeIn">
    <div class="container">
        <div class="col-md-12 text-center mb-5">
            <h4>Give Us A Visit Advance Academy</h4>
        </div>
    </div> <!-- END container-->
    <div class="position-relative">
        <div class="col-md-12" style="padding:auto; margin:auto; width:100%">
            {!! $about->map !!}
        </div>
       <div class="card card-body position-absolute absolute-center-y right-50 shadow-v3">
            <h6>Where to find us</h6>
            <div class="media mt-3 align-items-center">
                <i class="fa fa-map-marker"  aria-hidden="true"  style="padding-right:10px;"></i>
                <div class="media-body">
                    {{$about->location}}
                </div>
            </div>
            <ul class="list-unstyled mt-3">
                <li><i class="fa fa-phone "  style="padding-right:10px;"></i><a href="tel:+977{{$about->phone}}">+977 {{$about->phone}} </a></li>
                <li><i class="fa fa-envelope" style="padding-right:10px;"></i><a href="mailto:{{$about->email}}">{{$about->email}}</a></li>
            </ul>
        </div>
    </div>
</section>

@include('partials.footer')


</body>
