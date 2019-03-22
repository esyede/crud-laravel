@section('modal-add')
	<div class="form-group">
	    <label for="add-mp_name">Dari Marketplace</label>
	    <select id="add-mp_name" name="mp_name" class="form-control" required>
            <option value="bukalapak">Bukalapak</option>
            <option value="jakmall">Jakmall</option>
            <option value="shopee">Shopee</option>
            <option value="tokopedia">Tokopedia</option>
        </select>
	</div>
	<div class="form-group">
		<label for="add-link">Link Target</label>
		<textarea id="add-link" name="link" rows="3" class="form-control" 
			placeholder="Link target.." required></textarea>
	</div>
@stop

@section('modal-adjust')
	<div class="row">
		<div class="col-sm-2">
			<label for="adjust-target" class="col-sm-2 control-label pull-left">Target</label>
		</div>
		<div class="col-sm-10">
			<select id="adjust-target" name="target" class="form-control" required>
				<option value="deskripsi" selected="selected">Deskripsi Produk</option>
				<option value="judul">Judul Produk</option>
			</select>
		</div>
	</div>
	<br>
	<div class="row">
		<label for="prefix-suffix" class="col-sm-2 control-label">Prefix/Suffix</label>
		<div class="col-sm-5">
			<input id="adjust-prefix" name="prefix" type="text" class="form-control" placeholder="Prefix..">
		</div>
		<div class="col-sm-5">
			<input id="adjust-suffix" name="suffix" type="text" class="form-control" placeholder="Suffix..">
		</div>
	</div>
	<br>
	<div class="row">
		<label for="replace" class="col-sm-2 control-label">Replace</label>
		<div class="col-sm-5">
			<textarea id="adjust-replace_from" name="replace_from" class="form-control" rows="3" 
				placeholder="Replace dari.."></textarea>
		</div>
		<div class="col-sm-5">
			<textarea id="adjust-replace_to" name="replace_to" class="form-control" rows="3" 
				placeholder="Replace menjadi.."></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-10">
			<span class="text-muted">
			    <div style="font-size: 11px;">
				   *) Untuk replace banyak teks, gunakan tanda <code>|</code> sebagai pemisah. <br>
				    Contoh: 
				    <code>
				    	diskon<mark>|</mark>voucher<mark>|</mark>Gojek
				    	<mark>|</mark>ongkir gratis<mark>|</mark>Grab<mark>|</mark>maksimal 7 hari
				    </code>
			    </div>
			</span>
		</div>
	</div>
@stop

@section('modal-export')
	<div class="form-group">
		<label for="export-name">Nama file</label>
		<input id="export-name" name="name" type="text" class="form-control" placeholder="Nama file.." required>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
                <label for="export-courier">Set ulang kurir</label>
                <select id="export-courier" name="courier[]" 
                	class="form-control select2 select2-hidden-accessible" 
                	data-placeholder="Pilih kurir.." style="width: 100%;" 
                	tabindex="-1" aria-hidden="true"  multiple="">
					<option value="jner">JNE REG</option>
					<option value="tikir">TIKI REG</option>
					<option value="jtr">J&amp;T REG</option>
					<option value="posr">POS REG</option>
                </select>
                <div class="text-muted" style="font-size: 11px;">
					Set ulang semua mode pengiriman barang. kosongkan jika tidak perlu
				</div>
              </div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="export-stock">Set ulang stok</label>
				<input id="export-stock" name="stock" type="text" 
					class="form-control" placeholder="Set stok..">
				<div class="text-muted" style="font-size: 11px;">
					Set ulang semua stok barang. kosongkan jika tidak perlu
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
	    <label for="export-ruleset">Terapkan aturan marketplace</label>
	    <select id="export-ruleset" name="ruleset" class="form-control">
	        <option value="" selected="">Tidak usah</option>
	        <option value="bukalapak">Bukalapak</option>
	        <option value="jakmall">Jakmall</option>
	        <option value="shopee">Shopee</option>
	        <option value="tokopedia">Tokopedia</option>
	    </select>
	    <div class="text-muted" style="font-size: 11px;">
	    	Jika opsi ini diaktifkan, data yang belum sesuai tidak akan dimasukkan ke dalam file CSV. 
	    	Set aturan masing-masing marketplace dapat anda baca 
	    	<a href="{{ route('home.tutorials') }}" target="_blank">di halaman panduan</a>
		</div>
	</div>
@stop

@section('modal-set-margin')
	<div class="form-group">
	    <label for="set-margin-value">Set Margin / Laba</label>
	    <input id="set-margin-value" name="set_margin" type="text" class="form-control" placeholder="Set margin.." required>
		<div class="text-muted" style="font-size: 11px;">
			Dalam rupiah. Contoh: 500, 1000, 5000, 10000, 50000
		</div>
	</div>
@stop