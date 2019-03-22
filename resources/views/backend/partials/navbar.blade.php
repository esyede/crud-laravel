<header class="main-header">
    <a href="{{ url('/') }}" class="logo">
        <span class="logo-mini">
            <i class="fa fa-diamond"></i>
        </span>
        <span class="logo-lg">
            {{ config('app.name', 'Site') }}
        </span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Beralih</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (auth())
                    @include('backend.partials.navbar_dropdown_notif')
                    @include('backend.partials.navbar_dropdown_profile')
                @else
                    <li><a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>