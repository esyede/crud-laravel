@extends('backend.layouts.app')
@section('contents')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
        {{ ucwords(str_replace('_', ' ', Route::current()->getName())) }}
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <form role="form" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="box-body">
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' has-error' : '' }}" name="username" value="{{ $username ?? old('username') }}" required autofocus>
                    @if ($errors->has('username'))
                    <span class="help-block text text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' has-error' : '' }}" name="password" value="{{ $password ?? old('password') }}" required>
                    @if ($errors->has('password'))
                    <span class="help-block text text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-sm-2 control-label">Ulangi Password</label>
                <div class="col-sm-10">
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat pull-right">Reset Password</button>
        </div>
    </form>
</div>
@stop