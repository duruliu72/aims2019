<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">

    <!--header Start-->
    @include('admin.header')
    <!--header end-->

    <!--sidebar start-->
    @include('admin.sidebar')
    <!--sidebar end-->

    <!--main content start-->
     @yield('content')
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  @include('admin.script')

</body>

</html>
