<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/dssc_logo_official.png') }}" type="image/png">


    <!-- Header -->
    @include('adminPartials.header')
</head>
<body>
@yield('content')
@include('adminPartials.navbar') 
@include('adminPartials.sidebar') 



<!-- Scripts -->
@include('adminPartials.scripts')
</body>
</html>



