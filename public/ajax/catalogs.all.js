var targetTable;
$(document).ready(function() {
	targetTable = $('#catalog-table').DataTable({
		serverSide: true,
		ajax: dataTablesAjaxUrl,
		columns: [
			{ data: 'name',        name: 'name' },
			{ data: 'description', name: 'description', orderable: false },
			{ data: 'created_at',  name: 'created_at',  orderable: false, searchable: false },
			{ data: 'updated_at',  name: 'updated_at',  orderable: false, searchable: false },
			{ data: 'action',      name: 'action',      orderable: false, searchable: false }
		]
	});
	$('#btn-action-add').on('click', function(event) {
		event.preventDefault();
		$('#modal-loader').hide();
		$('#form-add')[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		$('.add-messages').html('');
		$('#form-add').unbind('submit').bind('submit', function(event) {
			event.preventDefault();
			$('#modal-loader').show();
			$('.add-messages').html('');
			$('.text-danger').remove();
			var form     = $(this);
			var add_name = $('#add-name').val();
			var add_desc = $('#add-desc').val();
			console.log(add_name+' '+add_desc);
			if (add_name == '') {
				$('#add-name').closest('.form-group').addClass('has-error');
				$('#add-name').after('<p class="text-danger">Bilah nama wajib diisi</p>');
			}
			else { $('#add-name').closest('.form-group').removeClass('has-error'); }
			if (add_desc == '') {
				$('#add-desc').closest('.form-group').addClass('has-error');
				$('#add-desc').after('<p class="text-danger">Bilah deskripsi wajib diisi</p>');
			}
			else { $('#add-desc').closest('.form-group').removeClass('has-error'); }
			if (add_name && add_desc) {
				$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
				console.log(form.serialize());
				$.ajax({
					url      : form.attr('action'),
					type     : form.attr('method'),
					data     : form.serialize(),
					dataType : 'json',
					success: function(response) {
						console.log(response);
						$('#modal-loader').hide();
						if (response.success == true) {
							var sidebarCountBadge = parseInt($('#sidebar-catalog-count-badge').text());
							sidebarCountBadge = sidebarCountBadge + 1;
							$('#sidebar-catalog-count-badge').text(sidebarCountBadge.toString());
							console.log('Sidebar catalog count:' +sidebarCountBadge);
							$('.form-group').removeClass('has-error').removeClass('has-success');
							targetTable.ajax.reload(null, false);
							$('button[data-dismiss="modal"]').click();
							showToast(response.messages, 'success');
							$('#form-add')[0].reset();
						}
						else {
							$('#modal-loader').hide();
							$('.add-messages').html('<span class="text-red">'+response.messages+'</span>');
						}
					},
					error: function(response) {
						console.log(response);
		                $('#modal-loader').hide();
		                $('.add-messages').html('<span class="text-red">'+printErrorList(response)+'</span>');
		            }
				});				
			}
			else { $('#modal-loader').hide(); }
		});
	});
});

function edit(data_id = null) {
	var form = $('#form-edit');
	if (data_id) {
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		$('.edit-messages').html('');
		$('#data_id').remove();
		$('#form-edit')[0].reset();
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
		$.ajax({
			url      : form.attr('action'),
			type     : 'GET',
			data     : { id : data_id },
			dataType : 'json',
			success: function(response) {
				console.log(response);
				$('#edit-name').val(response.name);
				$('#edit-desc').val(response.description);
				$('#edit-desc').append('<input type="hidden" name="id" id="edit-id" value="'+response.id+'"/>');
				$('#form-edit').unbind('submit').bind('submit', function(event) {
					event.preventDefault();
					$('#modal-loader').show();
					$('.edit-messages').html('');
					$('.text-danger').remove();
					var form      = $(this);
					var edit_id   = $('#edit-id').val();
					var edit_name = $('#edit-name').val();
					var edit_desc = $('#edit-desc').val();
					if (edit_name == '') {
						$('#edit-name').closest('.form-group').addClass('has-error');
						$('#edit-name').after('<p class="text-danger">Bilah nama wajib diisi</p>');
					}
					else { $('#edit-name').closest('.form-group').removeClass('has-error'); }
					if (edit_desc == '') {
						$('#edit-desc').closest('.form-group').addClass('has-error');
						$('#edit-desc').after('<p class="text-danger">Bilah deskripsi wajib diisi</p>');
					}
					else { $('#edit-desc').closest('.form-group').removeClass('has-error'); }
					if (edit_name && edit_desc) {
						$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
						$.ajax({
							url      : form.attr('action'),
							type     : 'POST',
							data     : form.serialize(),
							dataType : 'json',
							success: function(response) {
								console.log(response);
								$('#modal-loader').hide();
								if (response.success == true) {
									$('.form-group').removeClass('has-error').removeClass('has-success');
									targetTable.ajax.reload(null, false);
									$('button[data-dismiss="modal"]').click();
									showToast(response.messages, 'success');
								}
								else { $('.add-messages').html('<span class="text-red">'+response.messages+'</span>'); }
							},
							error: function(response) {
								console.log(response);
								$('#modal-loader').hide();
				                $('.edit-messages').html('<span class="text-red">'+printErrorList(response)+'</span>');
				            }
				        });
					}
					else { $('#modal-loader').hide(); }
				});
			},
			error: function(response) {
				console.log(response);
				$('#modal-loader').hide();
                $('.edit-messages').html('<span class="text-red">'+printErrorList(response)+'</span>');
            }
		});
	}
	else {
		$('#modal-loader').hide();
		$('.edit-messages').html('<span class="text-red">'+printErrorList(response)+'</span>');
	}
}

function remove(data_id = null) {
	if (data_id) {
		swal({
			title               : 'Hapus',
			text                : 'Hapus katalog ini beserta semua produk didalamnya?',
			type                : 'warning',
			showCancelButton    : true,
			closeOnConfirm      : false,
			showLoaderOnConfirm : true,
			confirmButtonClass  : 'btn btn-danger btn-flat btn-responsive',
			confirmButtonText   : 'Ya, hapus!'
		}, function () {
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
			$.ajax({
				type     : 'POST',
				url      : $('#btn-action-remove').attr('data-action'),
				data     : { id: data_id },
				dataType : 'json',
				success: function(response) {
					console.log(response);
					if (response.success == true) {
						var sidebarCountBadge = parseInt($('#sidebar-catalog-count-badge').text());
						if (sidebarCountBadge > 0) {
							sidebarCountBadge = sidebarCountBadge - 1;
							$('#sidebar-catalog-count-badge').text(sidebarCountBadge.toString());
						}
						console.log('sidebarCountBadge:' +sidebarCountBadge);
						swal('Hore!', 'Data berhasil dihapus!', 'success');
						targetTable.ajax.reload(null, false);
					}
					else { swal('Huh!', response.messages, 'error'); }
				},
				error: function(response) {
					console.log(response);
					swal('Huh!', printErrorList(response), 'error');
				}
			});
		});
	}
	else { swal('Huh!', 'Data tidak ditemukan', 'error'); }
}


function printErrorList(response) {
	var errors     = response.responseJSON;
    var errorsHtml = '';
    $.each(errors.errors, function(key, value) {
      errorsHtml += value[0] + '<br>';
    });
    return errorsHtml;
}


function showToast(text, toastType = 'success') {
	switch (toastType) {
		case 'success' : toastr.success(text);  break;
		case 'danger'  : toastr.danger(text);   break;
		case 'warning' : toastr.warning(text);  break;
		case 'info'    : toastr.info(text);     break;
		default        : toastr.success(text);  break;
	}
	toastr.options = {
		'closeButton'       : true,
		'debug'             : false,
		'newestOnTop'       : true,
		'progressBar'       : true,
		'positionClass'     : 'toast-top-right',
		'preventDuplicates' : true,
		'onclick'           : null,
		'showDuration'      : '300',
		'hideDuration'      : '1000',
		'timeOut'           : '5000',
		'extendedTimeOut'   : '1000',
		'showEasing'        : 'swing',
		'hideEasing'        : 'linear',
		'showMethod'        : 'fadeIn',
		'hideMethod'        : 'fadeOut'
	}
}