@extends('backend.layouts.app')
@section('contents')
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Downloads</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
			<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body table-responsive">
		@if (in_array(auth()->user()->roles, ['admin', 'root']))
			<div class="btn-group">
				<button id="btn-action-add" class="btn btn-sm btn-success btn-flat btn-responsive" 
					data-toggle="modal" data-target="#modal-add">
				<i class="fa fa-plus"></i> Tambah
				</button>
			</div>
		@endif
		<div class="clearfix"></div>
		<table id="catalog-table" class="table table-hover table-responsive">
			<thead>
				<tr role="row">
					<th>Nama</th>
					<th>Dibuat</th>
					<th>Diperbarui</th>
					<th>Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="box-footer">
		<a href="{{ route('home') }}" class="btn btn-default btn-flat btn-responsive">Kembali</a>
	</div>
</div>
@stop

@include('home.links.modal-all-sections')

@push('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables.bootstrap.js') }}"></script>
<script src="{{ asset('js/icheck.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
	var dataTablesAjaxUrl = '{{ route('home.links.json_all', ['id' => '1']) }}';
	var linkType = 'download';
</script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('ajax/links.all.js') }}"></script>
@include('home.links.modal-all')
@endpush
