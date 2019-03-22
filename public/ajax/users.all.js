var targetTable;
$(document).ready(function() {
	targetTable = $('#user-table').DataTable({
		serverSide: true,
		ajax: dataTablesAjaxUrl,
		columns: [
			{ data: 'name',       name: 'name' },
			{ data: 'username',   name: 'username' },
			{ data: 'roles',      name: 'roles' },
			{ data: 'created_at', name: 'created_at' },
			{ data: 'expired_at', name: 'expired_at' },
			{ data: 'action',     name: 'action', orderable: false, searchable: false}
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
			var form           = $(this);
			var add_name       = $('#add-name').val();
			var add_username   = $('#add-username').val();
			var add_password   = $('#add-password').val();
			var add_expired_at = $('#add-expired_at').val();
			if (add_name == '') {
				$('#add-name').closest('.form-group').addClass('has-error');
				$('#add-name').after('<p class="text-danger">Bilah nama wajib diisi</p>');
			}
			else { $('#add-name').closest('.form-group').removeClass('has-error');	}
			if (add_username == '') {
				$('#add-username').closest('.form-group').addClass('has-error');
				$('#add-username').after('<p class="text-danger">Bilah username wajib diisi</p>');
			}
			else { $('#add-username').closest('.form-group').removeClass('has-error'); }
			if (add_password == '') {
				$('#add-password').closest('.form-group').addClass('has-error');
				$('#add-password').after('<p class="text-danger">Bilah password wajib diisi</p>');
			}
			else { $('#add-password').closest('.form-group').removeClass('has-error'); }
			if (add_expired_at == '') {
				$('#add-expired_at').closest('.form-group').addClass('has-error');
				$('#add-expired_at').after('<p class="text-danger">Bilah durasi masa aktif wajib diisi</p>');
			}
			else { $('#add-expired_at').closest('.form-group').removeClass('has-error'); }
			if (add_name && add_username && add_password && add_expired_at) {
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
							var sidebarCountBadge = parseInt($('#sidebar-users-count-badge').text());
							sidebarCountBadge = sidebarCountBadge + 1;
							$('#sidebar-users-count-badge').text(sidebarCountBadge.toString());
							console.log('Sidebar users count:' +sidebarCountBadge);
							targetTable.ajax.reload(null, false);
							$('button[data-dismiss="modal"]').click();
							showToast(response.messages, 'success');
							$('#form-add')[0].reset();
						}
						else { $('.add-messages').html('<span class="text-red">'+response.messages+'</span>'); }
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
				$('#edit-password').val(response.password);
				$('#edit-password').append('<input type="hidden" name="id" id="edit-id" value="'+response.id+'"/>');
				end_date = response.expired_at.split(' ')[0];
				$('#edit-expired_at').val(response.expired_at.split(' ')[0]);
				$('#edit-expired_at').change(function() {
					end_date = response.expired_at.split(' ')[0];
					$(this).val(response.expired_at.split(' ')[0]);
				});
				$('#edit-expired_at').datepicker({ endDate: end_date, format: 'yyyy-mm-dd', clearBtn: true, autoclose: true });
				$('#form-edit').unbind('submit').bind('submit', function(event) {
					event.preventDefault();
					$('.edit-messages').html('');
					$('#modal-loader').show();
					$('.text-danger').remove();
					var form            = $(this);
					var edit_id         = $('#edit-id').val();
					var edit_name       = $('#edit-name').val();
					var edit_password   = $('#edit-password').val();
					var edit_expired_at = $('#edit-expired_at').val();
					if (edit_name == '') {
						$('#edit-name').closest('.form-group').addClass('has-error');
						$('#edit-name').after('<p class="text-danger">Bilah nama wajib diisi</p>');
					}
					else { $('#edit-name').closest('.form-group').removeClass('has-error'); }
					if (edit_name) {
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
									$('.edit-messages').html('<span class="text-green">'+response.messages+'</span>');
									targetTable.ajax.reload(null, false);
									$('button[data-dismiss="modal"]').click();
									showToast(response.messages, 'success');
								}
								else { $('.edit-messages').html('<span class="text-red">'+response.messages+'</span>'); }
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

function renew(data_id = null) {
	var form = $('#form-renew');
	if (data_id) {
		$('#modal-loader').hide();
		$('#form-renew')[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		$('.renew-messages').html('');
		$('#form-renew').unbind('submit').bind('submit', function(event) {
			event.preventDefault();
			$('#modal-loader').show();
			$('.renew-messages').html('');
			$('.text-danger').remove();
			var form             = $(this);
			var renew_expired_at = $('#renew-expired_at').val();
			if (renew_expired_at == '') {
				$('#renew-expired_at').closest('.form-group').addClass('has-error');
				$('#renew-expired_at').after('<p class="text-danger">Bilah deskripsi wajib diisi</p>');
			}
			else { $('#renew-expired_at').closest('.form-group').removeClass('has-error'); }
			if (renew_expired_at) {
				$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
				$.ajax({
					url      : form.attr('action'),
					type     : 'POST',
					data     : { id: data_id, expired_at: renew_expired_at },
					dataType : 'json',
					success: function(response) {
						console.log(response);
						$('#modal-loader').hide();
						if (response.success = true) {
							targetTable.ajax.reload(null, false);
							$('button[data-dismiss="modal"]').click();
							showToast(response.messages, 'success');
						}
						else { $('.renew-messages').html('<span class="text-red">'+response.messages+'</span>'); }
					},
					error: function(response) {
						console.log(response);
		                $('#modal-loader').hide();
		                $('.renew-messages').html('<span class="text-red">'+printErrorList(response)+'</span>');
		            }
				});				
			}
			else { $('#modal-loader').hide(); }
		});
	}
	else {
		$('#modal-loader').hide();
		$('.renew-messages').html('<span class="text-red">'+printErrorList(response)+'</span>');
	}
}

function change_roles(data_id = null) {
	if (data_id) {
		swal({
			title               : 'Level',
			text                : 'Ubah level pemilik akun ini?',
			type                : 'info',
			showCancelButton    : true,
			closeOnConfirm      : false,
			showLoaderOnConfirm : true,
			confirmButtonClass  : 'btn bg-maroon btn-flat btn-responsive',
			confirmButtonText   : 'Ya, ubah!'
		}, function() {
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
			$.ajax({
				type     : 'POST',
				url      : $('#btn-action-change_roles').attr('data-action'),
				data     : { id: data_id },
				dataType : 'json',
				success: function(response) {
					if (response.success == true) {
						console.log(response);
						swal('Hore!', response.messages, 'success');
						targetTable.ajax.reload(null, false);
					}
					else { swal('Huh!', response.messages, 'error') }
				},
				error: function(response) {
					console.log(response);
					swal('Huh!', printErrorList(response), 'error');
				}
			});
		});
	}
	else { swal('Huh!', 'Akun tidak ditemukan', 'error'); }
}

function remove(data_id = null) {
	if (data_id) {
		swal({
			title               : 'Hapus',
			text                : 'Hapus akun ini beserta semua data miliknya?',
			type                : 'warning',
			showCancelButton    : true,
			closeOnConfirm      : false,
			showLoaderOnConfirm : true,
			confirmButtonClass  : 'btn btn-danger btn-flat btn-responsive',
			confirmButtonText   : 'Ya, hapus!'
		}, function() {
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
			$.ajax({
				type     : 'POST',
				url      : $('#btn-action-remove').attr('data-action'),
				data     : { id: data_id },
				dataType : 'json',
				success: function(response) {	
					console.log(response);
					if (response.success == true) {
						swal('Hore!', response.messages, 'success');
						var sidebarCountBadge = parseInt($('#sidebar-catalog-count-badge').text());
						console.log('sidebarCountBadge:' +sidebarCountBadge);
						if (sidebarCountBadge > 0) {
							sidebarCountBadge = sidebarCountBadge - 1;
							$('#sidebar-users-count-badge').text(sidebarCountBadge.toString());
						}
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
	else { swal('Huh!', 'Akun tidak ditemukan', 'error'); }
}

function swap() {
	swal({
		title               : 'Sapu',
		text                : 'Sapu bersih semua akun yang kadaluwarsa?',
		type                : 'warning',
		showCancelButton    : true,
		closeOnConfirm      : false,
		showLoaderOnConfirm : true,
		confirmButtonClass  : 'btn bg-red btn-flat btn-responsive',
		confirmButtonText   : 'Ya, sapu!'
	}, function() {
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } })
		$.ajax({
			type     : 'POST',
			url      : $('#btn-box-swap').attr('data-action'),
			data     : { swap: true },
			dataType : 'json',
			success: function(response) {	
				console.log(response);
				if (response.success == true) {
					swal('Hore!', response.messages, 'success');
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
		'closeButton'      : true,
		'debug'            : false,
		'newestOnTop'      : true,
		'progressBar'      : true,
		'positionClass'    : 'toast-top-right',
		'preventDuplicates': true,
		'onclick'          : null,
		'showDuration'     : '300',
		'hideDuration'     : '1000',
		'timeOut'          : '5000',
		'extendedTimeOut'  : '1000',
		'showEasing'       : 'swing',
		'hideEasing'       : 'linear',
		'showMethod'       : 'fadeIn',
		'hideMethod'       : 'fadeOut'
	}
}