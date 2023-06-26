@include('partials.head')
@include('partials.header')

<style>
      @media (max-width: 991.98px) {
      .main-content .container-fluid {
        padding-left: 15px;
        padding-right: 15px; } }
  .main-content .photos .photo-item {
    position: relative; }
    .main-content .photos .photo-item:after {
      position: absolute;
      content: "";
      left: 0;
      right: 0;
      bottom: 0;
      top: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 1;
      -webkit-transition: .3s all ease;
      -o-transition: .3s all ease;
      transition: .3s all ease;
      opacity: 0;
      visibility: hidden; }
    .main-content .photos .photo-item .photo-text-more {
      position: absolute;
      z-index: 3;
      top: 50%;
      left: 50%;
      width: 100%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      margin-top: 30px;
      -webkit-transition: .3s all ease;
      -o-transition: .3s all ease;
      transition: .3s all ease;
      opacity: 0;
      visibility: hidden;
      text-align: center; }
      .main-content .photos .photo-item .photo-text-more .icon {
        color: #fff;
        font-size: 20px; }
      .main-content .photos .photo-item .photo-text-more .heading {
        font-size: 16px;
        color: #fff;
        margin-bottom: 0; }
      .main-content .photos .photo-item .photo-text-more .meta {
        color: #cccccc;
        text-transform: uppercase;
        font-size: 12px; }
    .main-content .photos .photo-item img {
      width: 100%;
      -o-object-fit: cover;
      object-fit: cover;
      height: 300px;
      margin-bottom: 20px; }
      @media (max-width: 575.98px) {
        .main-content .photos .photo-item img {
          height: 200px; } }
    .main-content .photos .photo-item:hover:after {
      opacity: 1;
      visibility: visible; }
    .main-content .photos .photo-item:hover .photo-text-more {
      margin-top: 0;
      opacity: 1;
      visibility: visible; }

</style>


<div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url({{asset('frontend/img/breadcrumb-bg.jpg')}}) no-repeat">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-md-6 text-white">
                <h2> Gallery</h2>
            </div>
            <div class="col-md-6" style="color: white;">
                <ol class="breadcrumb justify-content-md-end bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{route('index')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                       Gallery
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="" style="padding-top:20px;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-12 text-center mb-md-4">
                <h2 class="mb-4">
                    Memory of Advance Academy
                </h2>
                <div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
            </div>
        </div>
<main class="main-content">
    <div class="container-fluid photos">
    <div class="row align-items-stretch">


        @foreach($galleries as $gallery)
    <div class="col-lg-4 " data-aos="fade-up" style="padding:3px;">
    <a href="{{route('single.gallery',$gallery->id)}}" class="d-block photo-item">
    <img src="{{asset('storage/'.$gallery->image)}}" alt="Image" class="img-fluid">
    <div class="photo-text-more">
    <div class="photo-text-more">
    <h3 class="heading">{{$gallery->title}}</h3>
    <span class="meta">{{count($gallery->images)}} photos</span>
    </div>
    </div>
    </a>
    </div>
    @endforeach



    </div>
    </div>
    </main>
    </div>
</section>












@include('partials.footer')
