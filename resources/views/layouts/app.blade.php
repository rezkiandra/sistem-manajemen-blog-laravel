<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('src/assets/images/favicon.png') }}" />
  <title>
    @yield('title') - SIMANBLOG
  </title>
  <link href="{{ asset('src/dist/css/style.min.css') }}" rel="stylesheet" />
  @stack('css')
</head>

<body>
  <x-pre-loader />

  <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    <x-navbar />
    <x-sidebar />

    <div class="page-wrapper">
      @yield('header')
      <div class="container-fluid">

        @yield('content')

      </div>
      <x-footer />
    </div>
  </div>
  <script src="{{ asset('src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('src/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('src/dist/js/feather.min.js') }}"></script>
  <script src="{{ asset('src/assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('src/dist/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('src/dist/js/custom.min.js') }}"></script>
  <script src="{{ asset('src/assets/extra-libs/sparkline/sparkline.js') }}"></script>
  @stack('js')
</body>

</html>
