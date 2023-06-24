@include('partials.head')
@include('partials.header')
<body>

<div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url('{{asset('frontend/img/breadcrumb-bg.jpg')}}') no-repeat">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-md-6 text-white">
                <h2> {{$gallery->title}}</h2>
            </div>
            <div class="col-md-6" style="color: white;">
                <ol class="breadcrumb justify-content-md-end bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{route('index')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('gallery')}}"> Gallery </a>
                    </li>

                </ol>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>






<section class="padding-y-100">
    <div class="col-md-12">
        <div class="row">

        </div> <!-- END row-->
        <div class="row col-md-12">
            <div class="container-fluid photos">
                <div class="row align-items-stretch">
                    @if(count($gallery->images) > 0)
                    @foreach ($gallery->images as $image)


                <div class="" data-aos="fade-up" style="padding:3px;">
                <a href="{{asset('storage/images/'.$image->image)}}" class="d-block photo-item" data-fancybox="gallery">
                <img src="{{asset('storage/images/'.$image->image)}}" alt="Image" class="img-fluid" style="height:300px;">
                <div class="photo-text-more">
                <span class="icon icon-search"></span>
                </div>
                </a>
                </div>
                @endforeach
                @else
                    <div>
                        Image not found in gallery <b>{{$gallery->title}}</b>
                    </div>
                @endif
                </div>
                </div>


        </div> <!-- END row-->
    </div> <!-- END container-->
</section>





@include('partials.footer')
