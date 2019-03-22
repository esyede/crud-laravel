@php
    $dateDiff = Carbon\Carbon::parse(auth()->user()->expired_at)->diffInDays(now());
    $minDays = 7;
@endphp
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        @if ($dateDiff <= $minDays)
            <span class="label label-warning">new</span>
        @endif
    </a>
    <ul class="dropdown-menu">
        <li class="header">Notifikasi</li>
        <li>
            <ul class="menu">
                <li style="margin: 10px;">
                    @if ($dateDiff <= $minDays)
                    <span>
                        <small><i class="fa fa-exclamation-circle"></i> Masa aktif anda {{ $dateDiff }} hari lagi.</small>
                    </span>
                    @else
                        <span class="text-muted">
                            <small><i class="fa fa-info-circle"></i> Tidak ada notifikasi baru..</small>
                        </span>
                    @endif
                </li>
            </ul>
        </li>
        <li class="footer">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Tutup</strong></a>
        </li>
    </ul>
    </li>