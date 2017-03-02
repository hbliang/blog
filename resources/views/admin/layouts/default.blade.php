<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin @yield('title')</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    {{-- custom css --}}
    @yield('css')

</head>
<body>
    @include('admin.partials.nav')


    <div class="container">
        @include('admin.partials.notifications')
    
        @yield('content')
    </div>

    @include('admin.partials.footer')
</body>

<script type="text/javascript" src="{{ asset('js/jquery-3.1.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 

    $('a.delete').click(function (e) {
        e.preventDefault();
        if (confirm("Are you sure you want to delete?")) {
            var form_id = $(this).attr('delete-form-id');
            $('#' + form_id).submit();
        }
    });
});
</script>
{{-- custom js --}}
@yield('js')
</html>
