
@include('partials.head')
@include('partials.header')
<body>


    <div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url({{asset('frontend/img/breadcrumb-bg.jpg')}}) no-repeat">
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
                           Notice
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
                                <a href="{{asset('storage/'.$notice->file)}}" class="h5" download>
                                    {{$notice->title}}
                                </a>
                            </div>
                        </div>
                        <a href="{{asset('storage/'.$notice->file)}}" class="btn btn-outline-primary" download>Read Notice</a>
                    </div>

                    @endforeach
                                    <div class="col-12 marginTop-80">
            </div>
{!! $notices->links('partials.custompaginator') !!}

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
