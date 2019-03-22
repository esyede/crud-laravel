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
    <div class="box-body">
        @if (session('resent'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>
            <i class="icon fa fa-check"></i> Hore!
            </h4>
            Link verifikasi baru telah dikirim ke email anda.
        </div>
        @endif
        <p>
            Sebelum memulai, harap cek terlebih dahulu apakah ada email masuk berisi link verifikasi dari kami.
            Jika anda memang belum menerimanya, silahkan klik tombol <i>'Kirim Ulang'</i> untuk
            meminta ulang email verifikasi.
        </p>
        <div class="box-footer">
            <a href="{{ route('verification.resend') }}" type="button" class="btn btn-primary btn-flat pull-right">
                Kirim Ulang
            </a>
        </div>
    </div>
    @stop