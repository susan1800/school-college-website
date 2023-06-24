@include('partials.head')
@include('partials.header')
<body>

<div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url({{asset('frontend/img/breadcrumb-bg.jpg')}}) no-repeat">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 " >
                <h2 style="color:white;">Welcome to Advance Academy</h2>
            </div>
            <div class="col-md-6" style="color:white;">
                <ol class="breadcrumb justify-content-md-end bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{route('index')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        Welcome To Advance Academy
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>


@if($principal)
<section class="paddingTop-80 pb-5 pb-md-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{asset('storage/'.$principal->image)}}" alt="">
            </div>
            <div class="col-md-6 mt-2">
                <h2>
                    <small class="text-primary d-block">
                        Welcome to Advance Academy.
                    </small>
                    Message From Principal.
                </h2>
               {!! $principal->details !!}
                <h4 class="mt-2">
                    {{$principal->name}}
                </h4>


            </div>
        </div>
    </div>
</section>
@endif


@if($viceprincipal)
<section class="paddingTop-80 pb-5 pb-md-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{asset('storage/'.$viceprincipal->image)}}" alt="">
            </div>
            <div class="col-md-6 mt-2">
                <h2>

                    Message From Vice Principal.
                </h2>
                {!!$viceprincipal->details !!}
                <h4 class="mt-2">
                    {{$viceprincipal->name}}
                </h4>
            </div>
        </div>
    </div>
</section>
@endif






@include('partials.footer')
