@extends('backend.layouts.app')
@section('contents')
<div class="row">
    <div class="col-md-8">
        <form role="form" action="{{ route('home.settings.site.edit') }}" method="POST">
            @csrf
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Umum</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('site_title') ? ' has-error' : '' }}">
                        <label for="site_title">Judul Situs</label>
                        <input name="site_title" value="{{ old('site_title', optional($settings)->site_title) }}"
                         id="site_title" type="text" class="form-control" placeholder="Website title.." required>
                        @if ($errors->has('site_title'))
                        <span class="help-block text-danger">{{ $errors->first('site_title') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{ $errors->has('max_login') ? ' has-error' : '' }}">
                                <label for="max_login">Maks. Login</label>
                                <input name="max_login" value="{{ old('max_login', optional($settings)->max_login) }}"
                                 id="max_login" type="text" class="form-control" placeholder="Website title.." required>
                                @if ($errors->has('max_login'))
                                <span class="help-block text-danger">{{ $errors->first('max_login') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{ $errors->has('registration_gate') ? ' has-error' : '' }}">
                                <label for="registration_gate">Registrasi</label>
                                <select class="form-control" name="registration_gate" id="registration_gate">
                                    <option value="{{ old('registration_gate', optional($settings)->registration_gate) }}"  style="display:none;">
                                        {{ $settings->registration_gate == 'open' ? 'Buka' : 'Tutup' }}
                                    </option>
                                    <option value="open">Buka</option>
                                    <option value="close">Tutup</option>
                                </select>
                                @if ($errors->has('registration_gate'))
                                <span class="help-block text-danger">{{ $errors->first('registration_gate') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('home') }}" type="button" class="btn btn-default btn-flat">Batal</a>
                    <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="panel-title">Status</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="text-center">
                    <span class="fa-stack text-green fa-5x">
                        <i class="fa fa-circle-o fa-stack-2x"></i>
                        <i class="fa fa-check fa-stack-1x"></i>
                    </span>
                </div>
                <dl class="dl-horizontal no-margin">
                    <hr>
                    <dt>Versi Laravel</dt>
                    <dd>{{ Illuminate\Foundation\Application::VERSION }}</dd>
                    <dt>Versi PHP</dt>
                    <dd>{{ phpversion() }}</dd>
                    <dt>Versi MariaDB</dt>
                    <dd>{{ DB::getPdo()->query('select version()')->fetch()[0] }}</dd>
                    <dt>Versi Server</dt>
                    <dd>{{ $_SERVER['SERVER_SOFTWARE'] }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection