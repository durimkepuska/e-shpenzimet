<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="{!! URL::asset('web_style/js/bootstrap.min.js') !!}"></script>


</head>
<body>
<div class="container">
<h2 style="text-align:center;">
   <a href="{!! url('/auth/login') !!}">Kyçu</a>  | e-Shpenzimet |
   <a href="{!! url('/') !!}">Web Faqja</a>
</h2>
<hr>
<div>
  <div class="cd-logo pull-left"  >
    <a href="#"><img src="{!! URL::asset('web_style/img/gjakovaweb.png') !!}"></a>
  </div>
    <div style="padding-top:150px;">

    </div>


    @yield('form')

</div>
<div class="form-group" style="width:400px;">
@include('errors.error_handler')
@include('partials.flash')
</div>
</div>
</body>
</html>
