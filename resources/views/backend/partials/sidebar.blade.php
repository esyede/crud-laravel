<aside class="main-sidebar">
    <section class="sidebar">
    @auth
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('images/avatar.png') }}" class="img-circle" alt="avatar">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                @if (Carbon\Carbon::parse(auth()->user()->expired_at)->lessThan(now())
                && !in_array(auth()->user()->roles, ['admin', 'root']))
                    <a href="#"><i class="fa fa-circle text-danger"></i> Kadaluwarsa</a>
                @else
                    <a href="#"><i class="fa fa-circle text-success"></i> Aktif</a>
                @endif
            </div>
        </div>
    @endauth
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">NAVIGASI UTAMA</li>
            @if (!auth())
            <li>
                <a href="{{ route('login') }}">
                    <i class="fa fa-user"></i><span>Login</span>
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}">
                    <i class="fa fa-user-plus"></i><span>Registrasi</span>
                </a>
            </li>
            @else
            <li>
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i><span>Dashboard</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('home.catalogs.all') }}">
                    <i class="fa fa-shopping-cart"></i><span>Katalog Saya</span>
                    <span id="sidebar-catalog-count-badge" class="badge pull-right-container">
                        {{ App\Catalog::select('id')->where('user_id', '=', auth()->user()->id)->count('id') }}
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cog"></i><span>Setelan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('home.settings.shop') }}">
                            <i class="fa fa-circle-o"></i> Setelan Toko
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home.settings.data') }}">
                            <i class="fa fa-circle-o"></i> Setelan Data
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home.settings.password') }}">
                            <i class="fa fa-circle-o"></i> Ganti Password
                        </a>
                    </li>
                </ul>
            </li>
            @if (in_array(auth()->user()->roles, ['admin', 'root']))
            <li class="treeview">
                <a href="#"><i class="fa fa-shield"></i><span>Administrasi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (auth()->user()->roles === 'root')
                        <li>
                            <a href="{{ route('home.settings.site') }}">
                                <i class="fa fa-circle-o"></i> Setelan Situs
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('home.users.all') }}">
                            <i class="fa fa-circle-o"></i> Anggota 
                            <span id="sidebar-users-count-badge" class="badge badge-primary pull-right-container">
                                {{ App\User::select('id')->where('roles', '<>', 'admin')->count('id') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li>
                <a href="{{ route('home.downloads') }}">
                    <i class="fa fa-cloud-download"></i><span>Download</span>
                </a>
            </li>
            <li>
                <a href="{{ route('home.tutorials') }}">
                    <i class="fa fa-youtube-play"></i><span>Tutorial</span>
                </a>
            </li>
            @endif
        </ul>
    </section>
</aside>