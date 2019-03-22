@extends('backend.layouts.app')
@section('contents')
<div class="row">
    <div class="col-md-8">
        <form action="{{ route('home.settings.password') }}" role="form" method="POST">
            @csrf
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ganti Password</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    @if ($success = Session::get('status'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Hore!</h4>
                            {!! $success !!}
                        </div>
                    @endif
                    <div class="form-group has-feedback{{ ($errors->has('password') || !blank(session('errorr.passwd'))) ? ' has-error' : '' }}">
                        <label for="password">Password saat ini</label>
                        <input name="password" type="password" id="password" class="form-control"
                            value="{{ old('password') }}" placeholder="Password saat ini.." required>
                        @if ($errors->has('password'))
                            <span class="help-block text-red">{{ $errors->first('password') }}</span>
                        @elseif (session('errorr.passwd'))
                            <span class="help-block text-red">{{ session('errorr.passwd') }}</span>
                        @endif
                    </div>
                    <div class="form-group has-feedback{{ ($errors->has('new_password') || !blank(session('error.newpass'))) ? ' has-error' : '' }}">
                        <label for="new_password">Password baru</label>
                        <input name="new_password" type="password" id="new_password" class="form-control"
                            value="{{ old('new_password') }}" placeholder="Password baru.." required>
                        @if ($errors->has('new_password'))
                            <span class="help-block text-red">{{ $errors->first('new_password') }}</span>
                        @elseif (session('error.newpass'))
                            <span class="help-block text-red">{{ session('error.newpass') }}</span>
                        @endif
                    </div>
                    <div class="form-group has-feedback{{ $errors->has('new_password') ? ' has-error' : '' }}">
                        <label for="new_password_confirmation">Konfirmasi password baru</label>
                        <input name="new_password_confirmation" type="text" id="current_new_password_confirmation" class="form-control"
                            value="{{ old('new_password_confirmation') }}" placeholder="Konfirmasi password baru.." required>
                        @if ($errors->has('new_password_confirmation'))
                            <span class="help-block text-red">{{ $errors->first('new_password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat pull-right">Ganti Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@include('backend.partials.profile-md4')
</div>
@endsection