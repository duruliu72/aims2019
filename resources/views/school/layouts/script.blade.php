    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{asset('school/js/jquery.mmenu.all.js')}}"></script>
    <script src="{{asset('school/js/jquery.waypoints.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('school/js/jquery.steps.min.js')}}"></script>
    <script src="{{asset('school/js/script.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#mmmenu").mmenu();
            var API = $("#mmmenu").data("mmenu");
            $("#mmmenu").click(function() {
                API.open();
            });
        });
    </script>
    @yield('uniqueScript')