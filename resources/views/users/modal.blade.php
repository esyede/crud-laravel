{{-- Add --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-add">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Tambah</h4>
            </div>
            <form id="form-add" action="{{ route('home.users.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @yield('modal-add') 
                    <span class="add-messages"></span>
                    <center>
                       <img id="modal-loader" class="img-responsive" 
                            src="{{ asset('images/loading_bar.gif') }}" style="display: none;">   
                    </center>
                </div>
                <div class="modal-footer">
                    <button id="btn-modal-close" type="button" class="btn btn-default btn-flat btn-responsive pull-left" data-dismiss="modal">
                        Tutup
                    </button>
                    <button id="btn-modal-submit" type="submit" class="btn btn-success btn-flat btn-responsive pull-right">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <form action="{{ route('home.users.edit') }}" method="POST" id="form-edit">
                @csrf
                <div class="modal-body">
                    @yield('modal-edit') 
                    <span class="edit-messages"></span>
                    <center>
                       <img id="modal-loader" class="img-responsive" 
                            src="{{ asset('images/loading_bar.gif') }}" style="display: none;">   
                    </center>
                </div>
                <div class="modal-footer">
                    <button id="btn-modal-close" type="button" class="btn btn-default btn-flat btn-responsive pull-left" data-dismiss="modal">
                        Tutup
                    </button>
                    <button id="btn-modal-submit" type="submit" class="btn btn-primary btn-flat btn-responsive pull-right">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Renew --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-renew">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Renew</h4>
            </div>
            <form action="{{ route('home.users.renew') }}" method="POST" id="form-renew">
                @csrf
                <div class="modal-body">
                    @yield('modal-renew') 
                    <span class="renew-messages"></span>
                    <center>
                       <img id="modal-loader" class="img-responsive" 
                            src="{{ asset('images/loading_bar.gif') }}" style="display: none;">   
                    </center>
                </div>
                <div class="modal-footer">
                    <button id="btn-modal-close" type="button" class="btn btn-default btn-flat btn-responsive pull-left" data-dismiss="modal">
                        Tutup
                    </button>
                    <button id="btn-modal-submit" type="submit" class="btn bg-purple btn-flat btn-responsive pull-right">
                        Renew
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>