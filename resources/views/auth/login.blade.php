<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
 <link rel="shortcut icon" href="{{asset('clientAdmin/img/favicon.png')}}">

  <title>Login</title>

  <!-- Bootstrap CSS -->
  <!-- <link href="{{asset('clientAdmin/css/bootstrap.min.css')}}" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- bootstrap theme -->
  <link href="{{asset('clientAdmin/css/bootstrap-theme.css')}}" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="{{asset('clientAdmin/css/elegant-icons-style.css')}}" rel="stylesheet" />
  <link href="{{asset('clientAdmin/css/font-awesome.min.css')}}" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="{{asset('clientAdmin/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('clientAdmin/css/style-responsive.css')}}" rel="stylesheet" />

</head>

<body class="login-img3-body">
  <div class="container">
    <form class="login-form" action="{{ route('login') }}" method="POST">
       @csrf
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autofocus>
          @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>
            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
        </div>
        <label class="checkbox">
                <input type="checkbox" value="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                <span class="pull-right"> <a href="{{ route('password.request') }}">  {{ __('Forgot Your Password?') }}</a></span>
            </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit"> {{ __('Login') }}</button>
        
      </div>
    </form>
  </div>
</body>

</html>