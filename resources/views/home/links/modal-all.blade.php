<div class="modal fade" tabindex="-1" role="dialog" id="modal-add">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Tambah</h4>
            </div>
            <form action="{{ route('home.links.add') }}" method="POST" id="form-add">
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
                    <button type="submit" id="add-modal-submit" class="btn btn-success btn-flat btn-responsive pull-right">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <form action="{{ route('home.links.edit') }}" method="POST" id="form-edit">
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
                    <button type="button" class="btn btn-default btn-flat btn-responsive pull-left" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" id="edit-modal-submit" class="btn btn-primary btn-flat btn-responsive pull-right">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>