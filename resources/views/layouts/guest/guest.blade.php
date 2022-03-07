<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Login</title>

  <!-- Core stylesheet files. REQUIRED -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}">

  <!-- Font Awesome -->
  <!-- WARNING: Font Awesome doesn't work if you view the page via file:// -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.css') }}">

  <!-- animate.css -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/animate.css/animate.css') }}">
  <!-- END: core stylesheet files -->
  <!-- Theme main stlesheet files. REQUIRED -->
  <link rel="stylesheet" href="{{ asset('assets/css/chaldene.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/theme-peter-river.css') }}">
  <!-- END: theme main stylesheet files -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body class="bg-clouds">
  @yield('content')

  <!-- Core javascript files. REQUIRED -->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>

  <!-- Bootstrap -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>
