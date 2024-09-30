<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


<!-- bootstrap link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- js link -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- copied from admin template -->
    
  <!-- plugins:css -->
  <link rel="stylesheet" href={{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}>
  <link rel="stylesheet" href={{ asset('admin/vendors/base/vendor.bundle.base.css') }}>
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href={{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}>
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href={{ asset('admin/css/style.css') }}>
  <!-- endinject -->
  <link rel="shortcut icon" href={{ asset('admin/images/favicon.png') }} />


    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    @livewireStyles
</head>
<body>
      <div class="container-scroller">
        @include('layouts.inc.admin.navbar')

        <div class="conatiner-fluid page-body-wrapper">
          @include('layouts.inc.admin.sidebar')
          <div class="main-panel">
            <div class="content-wrapper">
              @yield('content')
            </div>
          </div>
        </div>
      </div>
   

  <script src={{ asset("vendors/base/vendor.bundle.base.js") }}></script>
  <script src={{ asset("vendors/datatables.net/jquery.dataTables.js") }}></script>
  <script src={{ asset("vendors/datatables.net-bs4/dataTables.bootstrap4.js") }}></script>


  <script src={{ asset("js/off-canvas.js") }}></script>
  <script src={{ asset("js/hoverable-collapse.js") }}></script>
  <script src={{ asset("js/template.js") }}></script>


  <!-- custom js for this page -->
  <script src={{ asset("js/dashboard.js") }}></script>
  <script src={{ asset("js/data-table.js") }}></script>
  <script src={{ asset("js/jquery.dataTables.js") }}></script>
  <script src={{ asset("js/dataTables.bootstrap4.js") }}></script>
 <!-- end custom js for this page -->
    @yield('scripts')
    
    @livewireScripts
    @stack('script')
</body>
</html>