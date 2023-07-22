<!DOCTYPE html>
<html>
<head>
  <title>Simple Email Design</title>
  <style>
    /* Reset some default styles */
    body, p, h1, h2, h3, h4, h5, h6, ul, ol, li {
      margin: 0;
      padding: 0;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #333;
    }
    p {
      font-size: 16px;
      margin-bottom: 10px;
      color: #555;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }
    .button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>{{$details['name']}}</h1>
    <div style="float:right"><a href="https://advancefoundation.edu.np/admin/admissionforms"><button class="button" >View All Data</button></a></div>
    <h4>Mail From:<a href="mailto:{{$details['email']}}">{{$details['email']}}</a></h4>
    <p>Applicant Details</p>
    <p>Name:{{$details['name']}}</p>
    <p>Birthday:{{$details['birthday']}}</p>
    <p>Gender:@if($details['gender'] == 'm') Male @else Female @endif</p>
    <p>Birthday:{{$details['birthday']}}</p>
    <p>Nationality:{{$details['nationality']}}</p>
    <p>Mobile:{{$details['mobile']}}</p>
    <p>Parent Details:</p>
    <hr>
    <p>Father Name:{{$details['father_name']}}</p>
    <p>Father Number:{{$details['father_number']}}</p>
    <p>Course and school details:</p>
    <hr>
    <p>Course selected:{{$details['course']}}</p>
    <p>School Name:{{$details['school_name']}}</p>
    <p>See Grade:{{$details['see_grade']}}</p>
    <p>+2 grade:{{$details['neb_grade']}}</p>
    <p>+2 College Name:{{$details['neb_school_name']}}</p>
    <hr>
    <p>Query:{{$details['query']}}</p>
    <a href="mailto:{{$details['email']}}"><button class="button" >Reply</button></a>
  </div>


</body>
</html>
