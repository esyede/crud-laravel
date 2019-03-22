<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    Tambah Data
                </h4>
            </div>
            <div class="modal-body">
                @yield('modal-tambah')
            </div>
            <div class="modal-footer">
                <div class="error-messages"></div>
                <button id="btn-tambah" name="btn-tambah" type="button" class="btn btn-success btn-flat">Tambah</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    Edit Data
                </h4>
            </div>
            <div class="modal-body">
                @yield('modal-edit')
            </div>
            <div class="modal-footer">
                <div class="error-messages"></div>
                <button id="btn-edit" type="button" class="btn btn-primary btn-flat">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ekspor" tabindex="-1" role="dialog" aria-labelledby="modal-ekspor" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    Ekspor Data
                </h4>
            </div>
            <div class="modal-body">
                @yield('modal-ekspor')
            </div>
            <div class="modal-footer">
                <div class="error-messages"></div>
                <button id="btn-ekspor" type="button" class="btn bg-purple btn-flat">Ekspor</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-optimasi" tabindex="-1" role="dialog" aria-labelledby="modal-optimasi" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    Optimasi Data
                </h4>
            </div>
            <div class="modal-body">
                @yield('modal-optimasi')
            </div>
            <div class="modal-footer">
                <div class="error-messages"></div>
                <button id="btn-optimasi" type="button" class="btn btn-warning btn-flat">Terapkan</button>
            </div>
        </div>
    </div>
</div>