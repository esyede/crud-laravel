<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-cubes"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number">
                    {{ App\Product::select('id')->where('user_id', '=', auth()->user()->id)->count('id') }}
                </span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                    Produk dimiliki
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Katalog</span>
                <span class="info-box-number">
                    {{ App\Catalog::select('id')->where('user_id', '=', auth()->user()->id)->count('id') }}
                </span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                    Katalog dimiliki
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-user-secret"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Level</span>
                <span class="info-box-number">{{ strtoupper(auth()->user()->roles) }}</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                    Level anda
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-hourglass-end"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Kadaluwarsa</span>
                <span class="info-box-number">
                    {{ explode(' ', auth()->user()->expired_at)[0] }}
                </span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                    Tanggal kadaluwarsa
                </span>
            </div>
        </div>
    </div>
    
</div>