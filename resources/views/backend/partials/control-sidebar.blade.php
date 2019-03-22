<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active">
            <a href="#control-tab-judul" data-toggle="tab"><i class="fa fa-adjust"></i></a>
        </li>
        <li>
            <a href="#control-tab-deskripsi" data-toggle="tab"><i class="fa fa-align-left"></i></a>
        </li>
    </ul>
    <div class="tab-content">
        {{-- Tab pane one --}}
        <div class="tab-pane active" id="control-tab-judul">
            <h2 class="control-sidebar-heading text-center">Optimasi Produk</h3>
            <div class="form-group">
                <label for="title_prefix">Tambahkan Teks</label>
                <input name="title_prefix" type="text" class="form-control" id="title_prefix" placeholder="Teks awalan..">
                <br>
                <input name="title_suffix" type="text" class="form-control" id="title_suffix" placeholder="Teks akhiran..">
            </div>
            <div class="form-group">
                <label for="title_replace_from">Ganti Teks</label>
                <input name="title_replace_from" type="text" class="form-control" id="title_replace_from" placeholder="Teks target..">
                <br>
                <input name="title_replace_to" type="text" class="form-control"id="title_replace_to" placeholder="Teks pengganti..">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat pull-right btn-responsive">Terapkan</button>
            </div>
            <br>
            <p style="font-size: 11px;">*) Kosongkan yang tidak perlu</p>
        </div>
        {{-- Tab pane Two --}}
        <div class="tab-pane" id="control-tab-deskripsi">
            <h3 class="control-sidebar-heading">Form Example 2</h3>
            <div class="form-group">
                <label for="selectbox">Select Box</label>
                <select name="selectbox" class="form-control">
                    <option value="option-1" selected="">Option 1</option>
                    <option value="option-2">Option 2</option>
                </select>
            </div>
            <div class="form-group">
                <label for="textarea">Textarea Box</label>
                <textarea name="textarea" class="form-control" rows="3" id="textarea-1" placeholder="Text here.."></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat pull-right btn-responsive">Submit</button>
            </div>
        </div>
    </div>
</aside>
<div class="control-sidebar-bg"></div>