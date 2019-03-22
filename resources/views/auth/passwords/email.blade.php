@extends('backend.layouts.app')
@section('contents')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
        {{ ucwords(str_replace(['_', '.'], ' ', Route::current()->getName())) }}
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <form role="form" action="{{ route('password.username') }}" method="POST">
        @csrf
        <div class="box-body">
            <div class="form-group">
                <p class="text-center">
                    Anda akan melakukan reset password. <br>
                    Silahkan masukkan username yang anda gunakan pada saat pendaftaran. <br>
                    Link reset password akan dikirim ke alamat username ini.
                </p>
                <br>
                <br>
                <div class="clearfix"></div>
                <label for="username" class="col-sm-2 control-label">Username pendaftaran</label>
                <div class="col-sm-10">
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' has-error' : '' }}" name="username" value="{{ $username ?? old('username') }}" placeholder="Username pendaftaran.." required autofocus>
                    @if ($errors->has('username'))
                    <span class="help-block text text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat pull-right">Reset Password</button>
        </div>
    </form>
</div>
@stop