<header class="site-header text-white" style="background:#B40407;">
    <div class="container" style="background:#B40407;">
        <div class="row align-items-center justify-content-between mx-0">
            <ul class="list-inline d-none d-lg-block mb-0">

                <li class="list-inline-item mr-3">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-phone mr-2"></i>
                        <a href="tel:+977{{$about->phone}}" style="font-size: 12px; font-weight: bold">+977 {{$about->phone}}</a>
                    </div>
                </li>

            </ul>

            <ul class="list-inline mb-0">
                <li class="list-inline-item mr-0 p-md-3 p-2 border-right border-left border-white-0_1">
                    <a href="{{route('admission')}}">Admission Form</a>
                </li>
                <li class="list-inline-item mr-0 p-md-3 p-2 border-right border-white-0_1">
                    <a href="{{route('gallery')}}">Gallery</a>
                </li>
            </ul>
            <ul class="list-inline mb-0">
                @if($about->facebook)
                <li class="list-inline-item mr-0 p-3 border-right border-left border-white-0_1">
                    <a href="{{$about->facebook}}"><i class="ti-facebook"></i></a>
                </li>
                @endif
                @if($about->twitter)
                <li class="list-inline-item mr-0 p-3 border-right border-white-0_1">
                    <a href="#"><i class="ti-twitter"></i></a>
                </li>
                @endif
                @if($about->instagram)
                <li class="list-inline-item mr-0 p-3 border-right border-white-0_1">
                    <a href="{{$about->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
                </li>
                @endif
                @if($about->linkedin)
                <li class="list-inline-item mr-0 p-3 border-right border-white-0_1">
                    <a href="{{$about->linkedin}}"><i class="ti-linkedin"></i></a>
                </li>
                @endif
                @if($about->youtube)
                <li class="list-inline-item mr-0 p-3 border-right border-white-0_1">
                    <a href="{{$about->toutube}}"><i class="ti-youtube"></i></a>
                </li>
                @endif



            </ul>

        </div> <!-- END END row-->
    </div> <!-- END container-->
</header><!-- END site header-->
<style>
    @media only screen and (min-width: 1000px) {
    .heightdesktop{
        height:70px;
    }
}
</style>

<nav class="navbar navbar-expand-lg sticky-top bg-white heightdesktop" style="font-size: 19px;">
    <div class="navbar-brand">
        <a class="logo-default " href="{{route('index')}}"><img class="heightdesktop" alt=""  src="{{asset('assets/img/logo.jpg')}}"></a>


    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="hamburger hamburger--spin js-hamburger">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </button>

    <div class="collapse navbar-collapse when-collapsed" id="navbarSupportedContent">
        <ul class="nav navbar-nav ec-nav__navbar ml-auto">

            <li class="nav-item">

                <a class="nav-link" href="{{route('index')}}">Home</a>

            </li>

            <li class="nav-item nav-item__has-dropdown">

                <a class="nav-link dropdown-toggle" data-toggle="dropdown">About</a>
                <ul class="dropdown-menu">
                    <li> <a href="{{route('about')}}" class="nav-link__list">About Us</a></li>
                    <li><a href="{{route('welcomemessage')}}" class="nav-link__list">Welcome Message</a></li>
                    <li><a href="{{route('life')}}" class="nav-link__list">Life At Advance</a></li>

                </ul>
            </li>
            <li class="nav-item nav-item__has-dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Course</a>
                <ul class="dropdown-menu">
                    @foreach($courses as $course)
                    <li> <a href="{{route('course',$course->id)}}" class="nav-link__list">{{$course->title}}</a></li>
                    @endforeach
                </ul>

            </li>
            <li class="nav-item ">
                <a class="nav-link " href="{{route('scholarship')}}">Scholarship</a>

            </li>

            <li class="nav-item nav-item__has-dropdown">

                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Notices</a>
                <ul class="dropdown-menu">
                    <li> <a href="{{route('notice')}}" class="nav-link__list">Recent Notices</a></li>
                    <li><a href="{{route('event')}}" class="nav-link__list">Events</a></li>
                </ul>
            </li>

            <a class="nav-link" href="{{route('contact')}}">Contact Us</a>



        </ul>
    </div>
</nav>

 <!-- END site-search-->
