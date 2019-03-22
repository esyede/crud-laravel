@section('modal-add')
	<div class="form-group">
		<label for="name">Nama</label>
		<input id="add-name" name="name" type="text" class="form-control" placeholder="Nama katalog..">
	</div>
	<div class="form-group">
	    <label for="description">Deskripsi</label>
	    <textarea id="add-desc" name="description" 
	    	placeholder="Deskripsi katalog.." rows="3" class="form-control"></textarea>
	</div>
@stop

@section('modal-edit')
	<div class="form-group">
		<label for="name">Nama</label>
		<input id="edit-name" name="name" type="text" class="form-control" 
			value="{{ old('name') }}" placeholder="Nama katalog..">
	</div>
	<div class="form-group">
	    <label for="description">Deskripsi</label>
	    <textarea id="edit-desc" name="description" 
	    	placeholder="Deskripsi katalog.." rows="3" class="form-control">{{ old('description') }}</textarea>
	</div>
@stop