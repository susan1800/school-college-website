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
<h3>Message from Advance Academy</h3>
<p>from:<a href="mailto:{{$details['email']}}">{{$details['email']}}</a></p>
<h3>Name: {{$details['name']}}</h3>
<p>Number:{{$details['phone']}}</p>
<p>Message: <b> {{$details['message']}}</b></p>
   <a href="mailto:{{$details['email']}}"><button class="button" >Reply</button></a>
  </div>
</body>
</html>
