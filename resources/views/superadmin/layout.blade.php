<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin | Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/dssc_logo_official.png') }}" type="image/png">

    <!-- Header -->
    @include('adminPartials.header')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  

    @include('superadmin.navBar')
    @include('superadmin.sideBar')

    <div class="wrapper">
        @yield('content')
    </div>

    <!-- Scripts --> 
    @include('adminPartials.scripts')
</body>
</html>
