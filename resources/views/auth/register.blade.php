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
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icheck.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ route('welcome') }}"><b>Register</b></a>
            </div>
            <div class="register-box-body">
                <p class="register-box-msg">Mendaftar untuk memulai sesi</p>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" name="name" class="form-control" placeholder="Nama.." autofocus required>
                        <span class="fa fa-user form-control-feedback"></span>
                        @if ($errors->has('name'))
                        <span class="help-block text text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
                        <input type="text" name="username" class="form-control" placeholder="Username.." required>
                        <span class="fa fa-user form-control-feedback"></span>
                        @if ($errors->has('username'))
                        <span class="help-block text text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Password.."  required>
                        <span class="fa fa-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                        <span class="help-block text text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password.."  required>
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8"></div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Registrasi
                            </button>
                        </div>
                    </div>
                </form>
                <br>
                <a class="text text-center" href="{{ route('login') }}">
                    Sudah punya akun?
                </a>
            </div>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
        <script src="{{ asset('js/icheck.min.js') }}"></script>
    </body>
</html>