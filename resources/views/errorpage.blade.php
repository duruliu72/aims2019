<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>404-Page</title>
  <!-- Bootstrap CSS -->
  <link href="{{asset('clientAdmin/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="{{asset('clientAdmin/css/bootstrap-theme.css')}}" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="{{asset('clientAdmin/css/elegant-icons-style.css')}}" rel="stylesheet" />
  <link href="{{asset('clientAdmin/css/font-awesome.min.css')}}" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="{{asset('clientAdmin/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('clientAdmin/css/style-responsive.css')}}" rel="stylesheet" />
</head>

<body>
  <div class="page-404">
    <p class="text-404">404</p>
    <h2>Aww Snap!</h2>
    <p>Something went wrong or that page doesn’t exist yet. <br><a href="{{URL::to('/home')}}">Return Home</a></p>
  </div>
</body>

</html>