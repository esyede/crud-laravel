@extends('backend.layouts.app')
@section('contents')
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Katalog: {{ $data['catalog_name'] }} </h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
			<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body table-responsive">
		<div class="btn-group">
			<div class="btn-group">
				<button id="btn-action-add" class="btn btn-sm btn-success btn-flat btn-responsive" 
					data-toggle="modal" data-target="#modal-add">
				<i class="fa fa-plus"></i> Tambah
				</button>
			</div>
			<button id="btn-action-adjust" data-toggle="modal" data-target="#modal-adjust" 
				class="btn btn-sm bg-orange btn-flat btn-responsive">
			<i class="fa fa-sliders"></i> Optimasi
			</button>
			<button id="btn-action-synchronize" type="button" class="btn btn-sm bg-maroon btn-flat btn-responsive" 
				onclick="synchronize({{ $data['catalog_id'] }})">
			<i class="fa fa-refresh"></i> Sinkron
			</button>
			<button id="btn-action-export" type="button" data-toggle="modal" 
				data-target="#modal-export" class="btn btn-sm bg-purple btn-flat btn-responsive">
			<i class="fa fa-file-excel-o"></i> Ekspor
			</button>
			<div class="btn-group">
				<button id="btn-action-upload" type="button" 
					class="btn btn-sm btn-info btn-flat btn-responsive dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-cloud-upload"></i> Upload
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#"><span><i class="fa fa-cloud-upload"></i> Bukalapak</span></a></li>
					<li><a href="#"><span><i class="fa fa-cloud-upload"></i> Jakmall</span></a></li>
					<li><a href="#"><span><i class="fa fa-cloud-upload"></i> Shopee</span></a></li>
					<li><a href="#"><span><i class="fa fa-cloud-upload"></i> Tokopedia</span></a></li>
				</ul>
			</div>
		</div>
		<div class="clearfix"></div>
		<table id="product-table" class="table table-hover table-responsive">
			<thead>
				<tr role="row">
					<th>Gambar</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Berat</th>
					<th>Supplier</th>
					<th>Frame</th>
					<th>Tersedia</th>
					<th>Kategori</th>
					<th>Sumber</th>
					<th>Disinkron</th>
				</tr>
			</thead>
		</table>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<a href="{{ route('home.catalogs.all') }}" class="btn btn-default btn-flat btn-responsive">Kembali</a>
	</div>
</div>
@stop

@include('catalogs.modal-one-sections')

@push('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables.bootstrap.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/icheck.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>

<script>
	$(function() {
		var selected = [];
		// dataTable
		var targetTable = $('#product-table').DataTable({
			// 'processing': true,
			'serverSide': true,
			'ajax': '{{ route('home.catalogs.json_one', $data['catalog_id']) }}',
			'columns': [
				// { data: 'mark',          name: 'mark', orderable: false, searchable: false },
				{ data: 'image',         name: 'image', orderable: false, searchable: false },
				{ data: 'name',          name: 'name' },
				{ data: 'price',         name: 'price' },
				{ data: 'weight',        name: 'weight' },
				{ data: 'supplier',      name: 'supplier' },
				{ data: 'custom_image',  name: 'custom_image', searchable: false },
				{ data: 'status',        name: 'status', searchable: false },
				{ data: 'mp_categories', name: 'mp_categories' },
				{ data: 'mp_name',       name: 'mp_name', searchable: false },
				{ data: 'updated_at',    name: 'updated_at' }
			],
			rowCallback: function(row, data) {
	            if ($.inArray(data.DT_RowId, selected) !== -1) {
	                $(row).addClass('selected');
	            }
	        }
		});

		$('#product-table tbody').on('click', 'tr', function() {
	        var id = this.id;
	        var index = $.inArray(id, selected);
	        if (index === -1) {
	            selected.push(id);
	        }
	        else {
	            selected.splice(index, 1);
	        }
	        $(this).toggleClass('selected');
	        //
	        var ids = $.map(targetTable.rows('.selected').data(), function (item) {
		        return item[0]
		    });
		    console.log(ids);
		    console.log(targetTable.rows('.selected').data().length + ' row(s) selected');
	    });

		// Initialize select2 elements
		$('.select2').select2()
	});
</script>

@include('catalogs.modal-one')
@endpush
