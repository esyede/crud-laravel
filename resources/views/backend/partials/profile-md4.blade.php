<div class="col-md-4">
    <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-primary">
            <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('images/avatar.png') }}" alt="avatar">
            </div>
            <h3 class="widget-user-username">{{ auth()->user()->name }}</h3>
            <h5 class="widget-user-desc">{{ ucfirst(auth()->user()->roles )}}</h5>
        </div>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
                <li><a href="#">Level <span class="pull-right">{{ ucfirst(auth()->user()->roles) }}</span></a></li>
                <li><a href="#">Terdaftar <span class="pull-right">{{ explode(' ', auth()->user()->created_at)[0] }}</span></a></li>
                <li><a href="#">Diupdate <span class="pull-right">{{ explode(' ', auth()->user()->updated_at)[0] }}</span></a></li>
                <li><a href="#">Terakhir <span class="pull-right">{{ explode(' ', auth()->user()->expired_at)[0] }}</span></a></li>
            </ul>
        </div>
    </div>
</div>