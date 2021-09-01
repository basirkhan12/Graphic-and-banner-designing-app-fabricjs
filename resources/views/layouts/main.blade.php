<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  @auth
  <meta name="user_id" content="{{ auth()->user()->id }}">
  @endauth
  <title>
   @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  
  <!-- CSS Files -->
  <link href={{ asset("assets/css/bootstrap.min.css")}} rel="stylesheet" />
  <link href={{ asset("css/userprofile.css")}} rel="stylesheet" />
  <link href={{ asset("assets/css/now-ui-dashboard.css?v=1.5.0")}} rel="stylesheet" />
  <script src="{{ asset('js/app.js') }}" defer></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  

</head>

<body class="">
  <div class="wrapper ">
   
@include('layouts.sidebar')


    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      @include('layouts.navBar')
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
          @yield('content')
      </div>


    @include('layouts.footer')
    </div>
  </div>
 
  @yield('scripts')
  <script src="https://use.fontawesome.com/e549289241.js"></script>

</body>

</html>