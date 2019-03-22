@extends('backend.layouts.app')
@section('contents')
@include('backend.partials.stat_boxes')
<div class="row">
    <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <p class="text-justify">
                        Selamat datang di {{ strtolower(config('app.name', 'site')) }}. Jika teman - teman 
                        masih bingung atau ada yang ingin ditanyakan tentang penggunaan aplikasi ini, 
                        silahkan tanyakan melalui grup sosial media berikut:
                    </p>
                    <hr>
                    <strong><i class="fa fa-users margin-r-5"></i> Grup Official</strong>
                    <p class="text-muted">
                        <i class="fa fa-telegram margin-r-5 text-teal"></i>Telegram: 
                        <a href="https://group.telegram.com/groups/dropship_ninja">
                            https://group.telegram.com/groups/dropship_ninja
                        </a>
                        <br>
                        <i class="fa fa-whatsapp margin-r-5 text-green"></i>Whatsapp: 
                        <a href="https://chat.whatsapp.com/groups/dropship_ninja">
                            https://chat.whatsapp.com/groups/dropship_ninja
                        </a>
                        <br>
                        <i class="fa fa-facebook-square margin-r-5 text-primary"></i>Facebook: 
                        <a href="https://facebook.com/groups/dropship_ninja">
                            https://facebook.com/groups/dropship_ninja
                        </a>
                    </p>
                    <hr style="margin-bottom: 4px;">
                    <small class="text-muted" style="font-size: 11px;">
                        <i class="fa fa-asterisk"></i> Saya lebih aktif di Whatsapp dan Telegram, jadi kalo temen - temen 
                        perlu respon cepat, silahkan kontak saja via Whatsapp atau Telegram ya! Terimakasih.
                    </small>
                </div>

            </div>
        </div>
    </div>
    @include('backend.partials.profile-md4')
</div>
@endsection
