<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="generator" content="{{ config('app.name', 'Site') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Site') }}</title>
        <!--[if lt IE 9]>
        <script src="{{ asset('js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icheck.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all-skins.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">Login</div>
            <div class="login-box-body">
                @if (session('status'))
                    <p class="login-box-msg text-success">{{ session('status') }}</p>
                @elseif ($errors->any())
                    @foreach ($errors->all() as $error)
                    <p class="login-box-msg text-red">{{ $error }}</p>
                    @endforeach
                @else
                    <p class="login-box-msg">Masuk untuk memulai sesi</p>
                @endif
                <form action="{{ route('login') }}" method="POST">   
                    @csrf
                    <div class="form-group has-feedback
                        {{ ($errors->has('username') || $errors->has('password')) ? ' has-error' : '' }}">
                        <input type="text" name="username" class="form-control" placeholder="Username.." required>
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback
                        {{ ($errors->has('username') || $errors->has('password')) ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Password.."  required>
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label class="control-label">
                                    <div class="icheckbox_square-blue" style="position: relative;" aria-checked="{{ old('remember') ? 'true' : 'false' }}" aria-disabled="false">
                                        <input style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" type="checkbox" name="remember" id="remember">
                                        <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div> Ingat saya
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat btn-responsive">Login</button>
                        </div>
                    </div>
                </form>
                <br>
                <a href="{{ url('/') }}">Halaman depan</a>
            </div>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/icheck.min.js') }}"></script>
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
        <script type="text/javascript">
            // iCheck
          $(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
            });
          });
        </script>
    </body>
</html>