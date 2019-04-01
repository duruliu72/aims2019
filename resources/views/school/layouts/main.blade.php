<!DOCTYPE html>
<html lang="en">

<head>
    @include('school.layouts.head')
</head>

<body>
    <div>
        @include('school.layouts.header')
         <!-- Main Content Section -->
        <section id="main-content">
             @yield('content')
        </section>
        <!--    Footer Top Section-->
        @include('school.layouts.footer')
    </div>
    @include('school.layouts.mmenu')
    @include('school.layouts.script')
</body>

</html>
