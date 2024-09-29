<!DOCTYPE html>
<html dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('src/assets/images/favicon.png') }}">
  <title>@yield('title') - SIMANBLOG</title>
  <link href="{{ asset('src/dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>
  <div class="main-wrapper">
    <x-pre-loader />
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
      style="background:url({{ asset('src/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
      <div class="auth-box row">
        <div class="col-lg-7 col-md-5 modal-bg-img"
          style="background-image: url({{ asset('src/assets/images/big/3.jpg') }});">
        </div>
        <div class="col-lg-5 col-md-7 bg-white">
          <div class="p-3">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('src/assets/libs/popper.js/dist/umd/popper.min.js') }} "></script>
  <script src="{{ asset('src/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script>
    $(".preloader ").fadeOut();
  </script>
</body>

</html>
