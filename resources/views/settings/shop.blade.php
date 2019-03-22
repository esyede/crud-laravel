@extends('backend.layouts.app')
@section('contents')
<div class="row">
    <form role="form" action="#" method="POST">
        @csrf
        <div class="col-md-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="panel-title">Judul</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="title_add_text">Tambahkan teks</label>
                        <textarea name="title_add_text" class="form-control" rows="2" placeholder="Tambahkan teks.."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title_add_text_pos">Posisi</label>
                        <select name="title_add_text_pos" class="form-control">
                            <option value="" selected="" style="display:none;">Pilih posisi teks..</option>
                            <option value="before">Di awal judul</option>
                            <option value="after">Di akhir judul</option>
                            <option value="both">Di awal dan akhir judul</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="panel-title">Judul</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="title_replace_from">Ganti teks dari</label>
                        <textarea name="title_replace_from" class="form-control" rows="2" placeholder="Ganti dari.."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title_replace_to">Ganti teks menjadi</label>
                        <textarea name="title_replace_to" class="form-control" rows="2" placeholder="Ganti menjadi.."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Setelan Toko</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="target_link">Link title</label>
                        <input type="text" name="target_link" class="form-control" placeholder="Link title..">
                    </div>
                    <div class="form-group">
                        <div class="checkbox icheck">
                            <label class="control-label">
                                <div class="icheckbox_square-blue" style="position: relative;" 
                                    aria-checked="false" aria-disabled="false">
                                    <input style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" type="checkbox" name="checkmark" id="checkmark">
                                    <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                </div> Checkbox sample
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc_add_text_pos">Masukkan ke toko</label>
                        <select name="desc_add_text_pos" class="form-control">
                            <option value="" style="display:none">Pilih katalog..</option>
                            <option value="one">one</option>
                            <option value="two">two</option>
                            <option value="three">three</option>
                        </select>
                    </div>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tips" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Tips</a>
                            </li>
                            <li>
                                <a href="#catatan" data-toggle="tab"><i class="fa fa-paperclip"></i> Catatan</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tips">
                                <p class="text-muted">
                                    <small>
                                    Jika ingin mengganti banyak teks, gunakan tanda | sebagai pemisah. <br>
                                    Contoh: <br>
                                    <ol>
                                        <li class="text-muted">diskon|voucher|Gojek|Grab</li>
                                        <li class="text-muted">
                                            garansi 1 minggu|biaya return kami tanggung|maksimal 7 hari
                                        </li>
                                    </ol>
                                    </small>
                                </p>
                            </div>
                            <div class="tab-pane" id="catatan">
                                <p class="text-muted">
                                    <small>
                                    Catatan tentang proses scraping: <br>
                                    <ol>
                                        <li class="text-muted">
                                            Selalu gunakan link yang anda dapat dari chrome extension
                                            agar link selalu valid.
                                        </li>
                                        <li class="text-muted">
                                            Lama atau cepatnya proses scraping tergantung
                                            banyaknya produk yang ada pada link anda.
                                        </li>
                                    </ol>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('home') }}" type="button" class="btn btn-default btn-flat btn-responsive">Batal</a>
                    <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="panel-title">Deskripsi</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="desc_add_text">Tambahkan teks</label>
                        <textarea name="desc_add_text" class="form-control" rows="2" placeholder="Tambahkan teks.."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="desc_add_text_pos">Posisi</label>
                        <select name="desc_add_text_pos" class="form-control">
                            <option value="" selected="" style="display:none;">Pilih posisi teks..</option>
                            <option value="before">Di awal deskripsi</option>
                            <option value="after">Di akhir deskripsi</option>
                            <option value="both">Di awal dan akhir deskripsi</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="panel-title">Deskripsi</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="desc_replace_from">Ganti teks dari</label>
                        <textarea name="desc_replace_from" class="form-control" rows="2" placeholder="Ganti dari.."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="desc_replace_to">Ganti teks menjadi</label>
                        <textarea name="desc_replace_to" class="form-control" rows="2" placeholder="Ganti menjadi.."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection