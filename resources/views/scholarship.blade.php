@include('partials.head')
@include('partials.header')
<body>



<div class="padding-y-80 bg-cover" data-dark-overlay="6" style="background:url(frontend/img/breadcrumb-bg.jpg) no-repeat">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" >
                <h2 style="color: white;">Scholarship</h2>
            </div>
            <div class="col-md-6" style="color:white;">
                <ol class="breadcrumb justify-content-md-end bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        Scholarship
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>




<section class="paddingTop-50 paddingBottom-100 bg-light">
    <div class="container col-md-12" >

        <div class="list-card shadow-v1 p-4">

            <div >

                <div class="h4">
                    Advance Scholorship Overview
                </div>


<figure class="wp-block-table"><table border="2" style="width:100%;">
    <thead>
        <tr>
            <th>Title</th>
            <th>Quota</th>
            <th>Waive</th>
            <th>Eligibility</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($scholarships as $scholarship)
            <td style="padding-top:10px;padding-bottom:10px;">{{$scholarship->title}}</td>
            <td style="padding-top:10px;padding-bottom:10px;">{{$scholarship->quota}}</td>
            <td style="padding-top:10px;padding-bottom:10px;">{{$scholarship->waive}}</td>
            <td style="padding-top:10px;padding-bottom:10px;">{{$scholarship->eligibility}}</td>
            <td style="padding-top:10px;padding-bottom:10px;">{{$scholarship->remarks}}</td>
        @endforeach
        <tr>
        </tr>
    </tbody>
</table>
<figcaption>*Conditions Apply</figcaption></figure>



<h3>Fee Structure for this academic Session</h3>



<figure class="wp-block-table">
    <table border="2" style="width:100%;">
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Science</th>
                <th>Management</th>
                <th>Humanities</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach($feestructures as $fee)
            <tr>
                <tr>{{$i}}</tr>
                <td style="padding-top:10px; padding:bottom:10px;">{{$fee->title}}</td>
                <td style="padding-top:10px; padding:bottom:10px;">{{$fee->science}}</td>
                <td style="padding-top:10px; padding:bottom:10px;">{{$fee->management}}</td>
                <td style="padding-top:10px; padding:bottom:10px;">{{$fee->humanities}}</td>
                <td style="padding-top:10px; padding:bottom:10px;">{{$fee->remarks}}</td>
            </tr>
            @php
                $i++;
            @endphp
           @endforeach
        </table>

    </figure>
<p><em>Rs. 500/ month is charged for Computer Science students in Management and lab fee for Hotel Management is decided at the time of hotel visit.</em></p>



<h3>Hostel Fee for this academic Session</h3>



<figure class="wp-block-table">
    <table border="2" style="width:100%;">
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Amount</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach($hostelfees as $hostelfee)
            <tr>
                <td>{{$i}}</td>
                <td style="padding-top:10px; padding:bottom:10px;">{{$hostelfee->title}}</td>
                <td style="padding-top:10px; padding:bottom:10px;">{{$hostelfee->amount}}</td>
                <td style="padding-top:10px; padding:bottom:10px;">{{$hostelfee->remarks}}</td>
            </tr>
            @php
                $i++;
            @endphp
            @endforeach
        </tbody>
    </table>
</figure>
</div><!-- .entry-content -->

            </div>
        </div> <!-- END card-list-->
</section>
</body>

 @include('partials.footer')
