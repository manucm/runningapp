<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Running App</title>
    <link rel="stylesheet" href="{{ asset('css/file.css') }}">
    <style media="screen">
      #center-login {
        margin-top: 10em;
      }
    </style>
  </head>
  <body>
    <div id="center-login" class="container col-md-5">
      <div class="card">
          <h3 class="card-header bg-inverse text-info">Login</h3>
          <div class="card-block">
            @if ($errors->any())
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <ul class="list-unstyled">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif

              <form class="" action="{{ url('login') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group @if($errors->has('usuario')) has-danger @elseif (old('usuario')) has-success @else @endif">
                      <label class="form-control-label" for="usuario">Usuario</label>
                      <input type="text" class="form-control @if($errors->has('usuario')) form-control-danger @else form-control-success @endif"  id="usuario" name="usuario" value="{{ old('usuario') }}">
                      @if($errors->has('usuario'))<div class="form-control-feedback">{{ $errors->first('usuario') }}</div>@endif
                      {{-- <small class="form-text text-muted">Example help text that remains unchanged.</small>--}}
                  </div>
                  <div class="form-group @if($errors->has('password')) has-danger @elseif (old('password')) has-success @else @endif">
                    <label class="form-control-label" for="password">Contraseña</label>
                    <input  type="password" class="form-control @if($errors->has('password')) form-control-danger  @endif" id="password" name="password" >
                    @if($errors->has('password'))<div class="form-control-feedback">{{ $errors->first('password') }}</div>@endif
                    {{--<small class="form-text text-muted">Example help text that remains unchanged.</small>--}}
                  </div>
                  <button type="submit" class="btn btn-success pull-sm-right">login</button>
              </form>

        </div>
      </div>
    </div>


</html>
