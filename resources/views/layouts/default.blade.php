<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Running App</title>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/file.css') }}">
      <link rel="stylesheet" href="{{ asset('css/libraries/select2.css') }}">
      <link rel="stylesheet" href="{{ asset('js/libraries/datepicker/css/bootstrap-material-datetimepicker.css') }}">
      <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0./css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/libraries/jquery.dynatable.css') }}">
      <link rel="stylesheet" href="{{ asset('css/custom/general.css') }}">
      <link rel="stylesheet" href="{{ asset('css/custom/spinners.css') }}">
      @yield('css')
    </script>
  </head>
  <body>
      <div class="content container-fluid">
        <div class="col-sm-10 offset-sm-1 mt-2">
          <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand" href="#">Navbar</a>

              <div class="collapse navbar-collapse" id="navbarColor01">
                    @include('layouts.partials.menu')
                </div>
                <div class="pull-right" style="min-width:200px;">
                    @include('layouts.partials.user_profile')
                </div>
            </nav>
            <div class="row col-sm-4 mt-2" >
              @include('layouts.partials.migas_pan')
            </div>

            <div class="">
                @yield('content')
            </div>
            </div>




      </div>



    <script type="text/javascript" src="{{ asset('js/libraries/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/tether.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/boostrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/jquery.dynatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/datepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom/general.js') }}"></script>

    @yield('js')
  </body>
</html>
