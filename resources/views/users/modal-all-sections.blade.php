@section('modal-add')
	<div class="form-group">
		<label for="add-name">Nama</label>
		<input id="add-name" name="name" type="text" class="form-control" placeholder="Nama user.." required autofocus>
	</div>
	<div class="form-group">
		<label for="add-username">Username</label>
		<input id="add-username" name="username" type="text" class="form-control" placeholder="Username.." required>
	</div>
	<div class="form-group">
		<label for="add-password">Password</label>
		<input id="add-password" name="password" type="text" class="form-control" placeholder="Password.." required>
	</div>
	<div class="form-group">
		<label for="add-expired_at">Masa aktif</label>
			<select id="add-expired_at" name="expired_at" class="form-control" 
				style="width: 100%;" placeholder="Pilih durasi masa aktif.." required>
			<option value=""  selected="selected" style="display: none;">Pilih durasi masa aktif..</option>
			@for ($i = 0; $i < 12; $i++)
			<option value="{{ $i + 1 }}">{{ $i + 1 }} Bulan</option>
			@endfor
        </select>
	</div>
@stop

@section('modal-edit')
	<div class="form-group">
		<label for="edit-name">Nama</label>
		<input id="edit-name" name="name" type="text" class="form-control" placeholder="Nama user.." required autofocus>
	</div>
	<div class="form-group">
		<label for="edit-password">Password</label>
		<input id="edit-password" name="password" type="text" class="form-control" placeholder="Password..">
		<div class="text-muted" style="font-size: 11px;">Biarkan saja atau kosongkan jika tidak ingin mengubah password</div>
	</div>
	<div class="form-group">
		<label>Tanggal Kadaluwarsa</label>
		<div class="input-group date">
			<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			<input id="edit-expired_at" name="expired_at" type="text" class="form-control pull-right" placeholder="Tanggal kadaluwarsa..">
		</div>
		<div class="text-muted" style="font-size: 11px;">Biarkan saja atau kosongkan jika tidak ingin mengubah tanggal kadaluwarsa</div>
	</div>
@stop

@section('modal-renew')
	<div class="form-group">
		<label for="renew-expired_at">Tambah masa aktif</label>
		<select id="renew-expired_at" name="expired_at" class="form-control" placeholder="Pilih durasi masa aktif.." required>
			<option value=""  selected="selected" style="display: none;">Pilih durasi masa aktif..</option>
			@for ($i = 0; $i < 12; $i++)
			<option value="{{ $i + 1 }}">{{ $i + 1 }} Bulan</option>
			@endfor
        </select>
	</div>
@stop