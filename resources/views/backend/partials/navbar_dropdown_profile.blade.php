<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ asset('images/avatar.png') }}" class="user-image" alt="Avatar">
        <span class="hidden-xs">{{ auth()->user()->name }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="user-header">
            <img src="{{ asset('images/avatar.png') }}" class="img-circle" alt="User Image">
            <p>
                {{ auth()->user()->name }}
                <small>{{ explode(' ', auth()->user()->created_at)[0] }} - {{ explode(' ', auth()->user()->expired_at)[0] }}</small>
            </p>
        </li>

        <li class="user-footer">
            <div class="pull-left">
                <a href="{{ route('home.settings.password') }}" class="btn btn-default btn-flat">
                    <i class="fa fa-key"></i> Password
                </a>
            </div>
            <div class="pull-right">
                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</li>