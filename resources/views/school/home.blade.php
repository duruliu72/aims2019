@extends('school.layouts.main')
@section('title')
 <title>Chouddagram Secondary Pilot Girls' High School </title>
@endsection
@section('uniqueStyle')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
@endsection
@section('content')
    <!-- Slider Section -->
    @include('school.layouts.slider')
    <div id="instituteinfo">
            <span id="inst-bg"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="left">
                            <div class="title">
                                <h4>Head master speech</h4>
                            </div>
                            <div class="pro-pic">
                                <img src="{{asset('school/img/dd7d898287506d05d7b6272e3c21215c.jpg')}}" alt="">
                                <div class="degination">
                                    <h3>Professor Dr. Md. Harun-Ur-Rashid Askari</h3>
                                </div>
                            </div>
                            <div class="txt">
                                <p>We strive for higher standards. That’s our motto. For about three decades and a half, Islamic University, Kushtia Bangladesh has been trying hard to maintain standards on higher education and... <a href="">Read More</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="right">
                            <div class="title">
                                <h4>Oxford Noble School: A profile</h4>
                            </div>
                            <div class="txt">
                                <p>Islamic University is ranked as one of the top public universities in Bangladesh as well as the largest seat of higher education in the south-western part of the country. Situated 24 kilometers south of Kushtia and 22 kilometers north of Jhenidah district-town, the university is by-passed by Khulna-Kushtia National Highway which provides its lifeline of connectivity with the rest of the country. The passing of the Islamic University Act in 1980 conferred this institution the permanent prestige of being the first university established after the independence of Bangladesh, reflecting the hope and aspiration of the new nation striving to be on par with other international players through the promotion of science, business, humanities, and interfaith...<a href="">Read More</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
     <!-- Counter section -->
     @include('school.layouts.counter')
@endsection
@section('uniqueScript')
 <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
 <script src="{{asset('school/js/jquery.counterup.min.js')}}"></script>
 <script type="text/javascript">
      $(document).ready(function () {
     $('.slider').bxSlider({
         mode: 'fade',
         responsive: true,
         infiniteLoop: true,
         auto: true,
         speed: 1000
     });
     $('.counter').counterUp({
         delay: 10,
         time: 1000
     });
 });
 </script>
@endsection