<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
 <h2> <a href="{!! url('/auth/login') !!}">Login</a> </a> or <a href="{!! url('/auth/register') !!}">Register</a>   |  <a href="{!! url('/') !!}">Web</a></h2><hr>

    @yield('form')


</div>
</body>
</html>
