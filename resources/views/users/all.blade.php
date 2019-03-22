@extends('backend.layouts.app')
@section('contents')
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">All Users</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
			<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body table-responsive">
		<div class="btn-group">
			<button id="btn-box-add" class="btn btn-sm btn-success btn-flat btn-responsive" 
				data-toggle="modal" data-target="#modal-add">
				<i class="fa fa-plus"></i> Tambah
			</button>
			<button id="btn-box-swap" class="btn btn-sm btn-danger btn-flat btn-responsive" 
				data-action="{{ route('home.users.swap') }}" onclick="swap()">
				<i class="fa fa-recycle"></i> Sapu Bersih
			</button>
		</div>
		<div class="clearfix"></div>
		<table id="user-table" class="table table-hover table-responsive">
			<thead>
				<tr role="row">
					<th>Nama</th>
					<th>Username</th>
					<th>Level</th>
					<th>Dibuat</th>
					<th>Kadaluwarsa</th>
					<th>Kelola</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="box-footer">
		<a href="{{ route('home') }}" class="btn btn-default btn-flat btn-responsive">Kembali</i></a>
	</div>
</div>
@stop

@include('users.modal-all-sections')

@push('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables.bootstrap.js') }}"></script>
<script src="{{ asset('js/bootstrap.datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/icheck.min.js') }}"></script>
<script type="text/javascript">
	var dataTablesAjaxUrl = '{{ route('home.users.json_all') }}';
</script>
<script src="{{ asset('ajax/users.all.js') }}"></script>
@include('users.modal')
@endpush