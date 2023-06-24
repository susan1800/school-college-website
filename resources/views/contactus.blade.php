@include('partials.head')
@include('partials.header')
<body>

    <div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url({{asset('frontend/img/breadcrumb-bg.jpg')}}) no-repeat">
        <div class="container" >
            <div class="row align-items-center">
                <div class="col-md-6 text-white">
                    <h2> Contact Us</h2>
                </div>
                <div class="col-md-6" style="color: white;">
                    <ol class="breadcrumb justify-content-md-end bg-transparent">
                        <li class="breadcrumb-item">
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                           Contact us
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <!-- Success message -->
    </div>



<div class="py-5 shadow-v2 position-relative">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 mt-4">
                <div class="media">
                    <span class="iconbox iconbox-md bg-primary text-white"><i class="ti-mobile"></i></span>
                    <div class="media-body ml-3">
                        <h5 class="mb-0">+977 {{$about->phone}}</h5>
                        <p>Call Us (6:30AM-5PM)</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-4">
                <div class="media">
                    <span class="iconbox iconbox-md bg-primary text-white"><i class="ti-email"></i></span>
                    <div class="media-body ml-3">
                        <a href="mailto:{{$about->email}}" class="h5">{{$about->email}}</a>
                        <p>Contact Us (24 * 7)</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-4">
                <div class="media">
                    <span class="iconbox iconbox-md bg-primary text-white"><i class="ti-location-pin"></i></span>
                    <div class="media-body ml-3">
                        <h5 class="mb-0">{{$about->location}}</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




<section class="padding-y-100 bg-light-v2">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2>
                    Send Message
                </h2>
                <div class="width-4rem height-4 bg-primary my-2 mx-auto rounded"></div>
            </div>
            <div class="col-12 text-center">
                <form action="{{route('contact.store')}}" method="POST" class="card p-4 p-md-5 shadow-v1">
                    @csrf
                    <p class="lead mt-2">
                     We will reply to you as soon as possible.
                    </p>
                    @include('admin.partials.flash')

                    <div class="row mt-5 mx-0">
                        <div class="col-md-4 mb-4">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{old('name')}}" required>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{old('email')}}" required>
                            @error('email') {{ $message }} @enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}" maxlength="10" placeholder="Phone number">
                            @error('phone') {{ $message }} @enderror
                        </div>
                        <div class="col-12">
                            <textarea type="text" class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Message" value="{{old('message')}}" rows="7"></textarea>
                            @error('message') {{ $message }} @enderror
                            <button type="submit" class="btn btn-primary mt-4">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>

        </div> <!-- END row-->
    </div> <!-- END container-->
</section>

<section class="marginTop-100 wow fadeIn">
    <div class="container">
        <div class="col-12 text-center mb-5">
            <h4>Give Us A Visit Advance Academy</h4>
        </div>
    </div> <!-- END container-->
    <div class="position-relative">
        <div class="col-md-12">
            {!! $about->map !!}
        </div>

        <div class="card card-body position-absolute absolute-center-y right-50 shadow-v3">
            <h6>Where to find us</h6>
            <div class="media mt-3 align-items-center">
                <i class="ti-location-pin mr-2"></i>
                <div class="media-body">
                   {{$about->location}}
                </div>
            </div>
            <ul class="list-unstyled mt-3">
                <li><i class="ti-headphone mr-3"></i><a href="tel:+977{{$about->phone}}">+977 {{$about->phone}} </a></li>
                <li><i class="ti-email mr-3"></i><a href="mailto:{{$about->email}}">{{$about->email}}</a></li>
            </ul>
        </div>
    </div>
</section>

@include('partials.footer')
<div class="scroll-top">
    <i class="ti-angle-up"></i>
</div>

<script src="frontend/js/vendors.bundle.js"></script>
<script src="frontend/js/scripts.js"></script>
</body>
