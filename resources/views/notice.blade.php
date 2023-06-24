
@include('partials.head')
@include('partials.header')
<body>


    <div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url(frontend/img/breadcrumb-bg.jpg) no-repeat">
        <div class="container" >
            <div class="row align-items-center">
                <div class="col-md-6 text-white">
                    <h2> Notice</h2>
                </div>
                <div class="col-md-6" style="color: white;">
                    <ol class="breadcrumb justify-content-md-end bg-transparent">
                        <li class="breadcrumb-item">
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                           =Notice
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



<section class="paddingTop-50 paddingBottom-100 bg-light-v2">
    <div class="container">
        <div class="row" id="notices">
            <div class="col-lg-12 mt-5">

                @foreach($notices as $notice)
                    <div class="d-md-flex justify-content-between align-items-center bg-white shadow-v1 rounded mb-4 hover:transformLeft" style="padding-left:4px; padding-right:4px;">
                        <div class="media align-items-center">

                            <div class="text-center border-right pr-4" >
                                <strong class="text-primary font-size-38">
                                    {{ $notice->created_at->format('d') }}
                                </strong>
                                <p class="mb-0 text-gray">
                                    {{ $notice->created_at->format('M-Y') }}
                                </p>
                            </div>

                            <div class="media-body " style="padding-left:5px;">
                                <a href="{{asset('storage/'.$notice->file)}}" class="h5">
                                    {{$notice->title}}
                                </a>
                            </div>
                        </div>
                        <a href="{{asset('storage/'.$notice->file)}}" class="btn btn-outline-primary">Read Notice</a>
                    </div>

                    @endforeach

                                    <div class="col-12 marginTop-80">


                                        {{$notices->links()}}
                        <ul class="pagination pagination-primary justify-content-center">
                            <ul class="pagination" role="navigation">

                    <li class="page-item">
                <a class="page-link" href="notices235c.html?page=7" rel="prev" aria-label="&laquo; Previous">&lsaquo;</a>
            </li>





                                                                        <li class="page-item"><a class="page-link" href="notices2679.html?page=1">1</a></li>
                                                                                <li class="page-item"><a class="page-link" href="notices4658.html?page=2">2</a></li>
                                                                                <li class="page-item"><a class="page-link" href="notices9ba9.html?page=3">3</a></li>
                                                                                <li class="page-item"><a class="page-link" href="noticesfdb0.html?page=4">4</a></li>
                                                                                <li class="page-item"><a class="page-link" href="noticesaf4d.html?page=5">5</a></li>
                                                                                <li class="page-item"><a class="page-link" href="noticesc575.html?page=6">6</a></li>
                                                                                <li class="page-item"><a class="page-link" href="notices235c.html?page=7">7</a></li>
                                                                                <li class="page-item active" aria-current="page"><span class="page-link">8</span></li>
                                                                                <li class="page-item"><a class="page-link" href="notices0b08.html?page=9">9</a></li>


                    <li class="page-item">
                <a class="page-link" href="notices0b08.html?page=9" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
            </li>
            </ul>

                        </ul>
                    </div>


            </div>


        </div> <!-- END row-->
    </div> <!-- END container-->
</section>

@include('partials.footer')


<div class="scroll-top">
    <i class="ti-angle-up"></i>
</div>

<script src="frontend/js/vendors.bundle.js"></script>
<script src="frontend/js/scripts.js"></script>

<script>
    $(".seemore").click(function() {
        $div = $($(this).attr('data-div')); //div to append
        $link = $(this).attr('data-link'); //current URL

        $page = $(this).attr('data-page'); //get the next page #
        $href = $link + $page; //complete URL
        $.get($href, function(response) { //append data
            $html = $(response).find("#notices").html();
            $div.append($html);
        });

        $(this).attr('data-page', (parseInt($page) + 1)); //update page #
    });
</script>

</body>
