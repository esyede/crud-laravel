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
            <form action="#" method="POST" id="form-add">
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
                    <button type="button" class="btn btn-default btn-flat btn-responsive pull-left" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-success btn-flat btn-responsive pull-right">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Adjust --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-adjust">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Optimasi</h4>
            </div>
            <form action="#" method="POST" id="form-adjust">
                @csrf
                <div class="modal-body">
                    @yield('modal-adjust') 
                    <span class="adjust-messages"></span>
                    <center>
                       <img id="modal-loader" class="img-responsive" 
                            src="{{ asset('images/loading_bar.gif') }}" style="display: none;">   
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat btn-responsive pull-left" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn bg-orange btn-flat btn-responsive pull-right">
                        Optimasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Export --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-export">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Ekspor</h4>
            </div>
            <form action="#" method="POST" id="form-export">
                @csrf
                <div class="modal-body">
                    @yield('modal-export') 
                    <span class="export-messages"></span>
                    <center>
                       <img id="modal-loader" class="img-responsive" 
                            src="{{ asset('images/loading_bar.gif') }}" style="display: none;">   
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat btn-responsive pull-left" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn bg-purple btn-flat btn-responsive pull-right">
                        Ekspor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Set Margin --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modal-set-margin">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Set Margin</h4>
            </div>
            <form action="#" method="POST" id="form-set-margin">
                @csrf
                <div class="modal-body">
                    @yield('modal-set-margin') 
                    <span class="set-margin-messages"></span>
                    <center>
                       <img id="modal-loader" class="img-responsive" 
                            src="{{ asset('images/loading_bar.gif') }}" style="display: none;">   
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat btn-responsive pull-left" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary btn-flat btn-responsive pull-right">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>