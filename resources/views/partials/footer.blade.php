



<footer class="site-footer">
    <div class="footer-top text-white paddingBottom-100" style="background: #5C0404;">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 mt-5">
                    <img src="assets/img/logobg.png" alt="Logo">
                    <div class="margin-y-40">
                        <p>
                            Come, join us for a better future. Together today for a successful tomorrow.
                        </p>
                    </div>
                    <ul class="list-inline">
                        @if($about->facebook)
                        <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href="{{$about->facebook}}"><i class="ti-facebook"> </i></a></li>
                        @endif
                        @if($about->twitter)
                        <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href="{{$about->twitter}}"><i class="ti-twitter"> </i></a></li>
                        @endif
                        @if($about->linkedin)
                        <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href="{{$about->linkedin}}"><i class="ti-linkedin"> </i></a></li>
                        @endif
                        @if($about->instagram)
                        <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href="{{$about->instagram}}"><i class="ti-instagram"> </i></a></li>
                        @endif
                        @if($about->youtube)
                        <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href="{{$about->youtube}}"><i class="ti-youtube"> </i></a></li>
                        @endif


                    </ul>
                </div>

                <div class="col-lg-1 col-md-6 mt-5"></div>
                <div class="col-lg-4 col-md-6 mt-5">
                    <h4 class="h5 text-white">Contact Us</h4>
                    <div class="width-3rem bg-primary height-3 mt-3"></div>
                    <ul class="list-unstyled marginTop-40">
                        <li class="mb-3"><i class="ti-headphone mr-3"></i><a href="tel:+977{{$about->phone}}">+977{{$about->phone}}</a></li>
                        <li class="mb-3"><i class="ti-email mr-3"></i><a href="mailto:{{$about->email}}">{{$about->email}}</a></li>
                        <li class="mb-3">
                            <div class="media">
                                <i class="ti-location-pin mt-2 mr-3"></i>
                                <div class="media-body">
                                    <span> {{$about->location}}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-12 mt-5">
                    <h4 class="h5 text-white">Quick links</h4>
                    <div class="width-3rem bg-primary height-3 mt-3"></div>
                    <ul class="list-unstyled marginTop-40">
                        <li class="mb-2"><a href="aboutus.html">About Us</a></li>
                        <li class="mb-2"><a href="contactus.html">Contact Us</a></li>
                        <li class="mb-2"><a href="programs.html">Programs</a></li>
                        <li class="mb-2"><a href="admission.html">Admission</a></li>
                        <li class="mb-2"><a href="events.html">Events</a></li>
                        <li class="mb-2"><a href="notices.html">Latest News</a></li>
                    </ul>
                </div>


            </div> <!-- END row-->
        </div> <!-- END container-->
    </div> <!-- END footer-top-->

    <div class="footer-bottom bg-primary text-center" style="height: 40px; padding:0px;margin:0px;">
        <div class="container" style=" padding:0px;margin:0px;">
            <p class="text-white mb-0" style="font-size: 20px; padding:0px;margin:0px;">&copy; 2020 Advance Academy. All rights reserved.</p>
        </div>
    </div>  <!-- END footer-bottom-->
</footer> <!-- END site-footer -->


<div class="scroll-top">
    <i class="ti-angle-up"></i>
</div>
