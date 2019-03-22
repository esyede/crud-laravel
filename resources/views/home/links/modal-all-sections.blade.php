@section('modal-add')
	<div class="form-group">
		<label for="name">Nama Link</label>
		<input id="add-name" name="name" type="text" class="form-control" placeholder="Nama link..">
	</div>
	<div class="form-group">
	    <label for="url">Url Link</label>
	    <input id="add-url" name="url" type="text" class="form-control" placeholder="Url link..">
	</div>
@stop

@section('modal-edit')
	<div class="form-group">
		<label for="name">Nama Link</label>
		<input id="edit-name" name="name" type="text" class="form-control" placeholder="Nama link..">
	</div>
	<div class="form-group">
	    <label for="url">Url Link</label>
	    <input id="edit-url" name="url" type="text" class="form-control" placeholder="Url link..">
	</div>
@stop