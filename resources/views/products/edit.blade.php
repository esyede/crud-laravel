@extends('backend.layouts.app')
@section('contents')
<div class="row">
    <form role="form" name="edit" action="{{ route('home.products.edit', ['id' => $product->id]) }}" method="POST">
        @csrf
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Produk</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Nama Produk</label>
                        <input name="name" value="{{ old('name', optional($product)->name) }}"
                        type="text" class="form-control" placeholder="Judul..">
                        @if ($errors->has('name'))
                        <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="11"
                        placeholder="Deskripsi..">{{ old('description', optional($product)->description) }}</textarea>
                        @if ($errors->has('description'))
                        <span class="help-block text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('home.catalogs.all') }}"
                    type="button" class="btn btn-default btn-flat btn-responsive">Batal</a>
                    <button type="submit" class="btn btn-primary btn-responsive btn-flat pull-right">Simpan</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="panel-title">Gambar</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image">Link Gambar</label>
                        <div class="input-group input-group-sm">
                            <input name="image" type="text" value="{{ old('image', optional($product)->image) }}"
                            class="form-control" placeholder="Link image..">
                            <span class="input-group-btn">
                                <a href="{{ $product->image }}" target="_blank"
                                    type="button" class="btn btn-default btn-flat">
                                    <i class="fa fa-external-link"></i>
                                </a>
                            </span>
                        </div>
                        @if ($errors->has('image'))
                        <span class="help-block text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="panel-title">Lain - lain</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('courier') ? ' has-error' : '' }}">
                        <label for="courier">Kurir</label>
                        <select name="courier[]" id="courier" class="form-control select2 select2-hidden-accessible" 
                            data-placeholder="Pilih kurir.." style="width: 100%;" 
                            tabindex="-1" aria-hidden="true" multiple="true" 
                            data-placeholder="Pilih kurir pengiriman..">
                            <option value="jner">JNE REG</option>
                            <option value="tikir">TIKI REG</option>
                            <option value="jtr">J&amp;T REG</option>
                            <option value="posr">POS REG</option>
                        </select>
                        <div class="text-muted" style="font-size: 11px;">*) Biarkan kosong jika tidak imgin diubah</div>
                        @if ($errors->has('courier'))
                        <span class="help-block text-danger">{{ $errors->first('courier') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group has-feedback {{ $errors->has('margin') ? ' has-error' : '' }}">
                                <label for="margin">Margin / Laba</label>
                                <input name="margin" type="text" value="{{ old('margin', optional($product)->margin) }}"
                                class="form-control" placeholder="Stok barang..">
                                @if ($errors->has('margin'))
                                <span class="help-block text-danger">{{ $errors->first('margin') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback {{ $errors->has('assurance') ? ' has-error' : '' }}">
                                <label for="assurance">Asuransikan?</label>
                                <select name="assurance" class="form-control" id="assurance">
                                    <option value="{{ old('assurance', optional($product)->assurance) }}"
                                        selected="selected" style="display: none;">
                                        {{ $product->assurance == 'yes' ? 'Ya' : 'Tidak' }}
                                    </option>
                                    <option value="yes">Ya</option>
                                    <option value="no">Tidak</option>
                                </select>
                                @if ($errors->has('assurance'))
                                <span class="help-block text-danger">{{ $errors->first('assurance') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group has-feedback {{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight">Berat (gram)</label>
                                <input name="weight" type="text" value="{{ old('weight', optional($product)->weight) }}"
                                class="form-control" placeholder="Stok barang..">
                                @if ($errors->has('weight'))
                                <span class="help-block text-danger">{{ $errors->first('weight') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback {{ $errors->has('stock') ? ' has-error' : '' }}">
                                <label for="stock">Stok</label>
                                <input name="stock" type="text" value="{{ old('stock', optional($product)->stock) }}"
                                class="form-control" placeholder="Stok barang..">
                                @if ($errors->has('stock'))
                                <span class="help-block text-danger">{{ $errors->first('stock') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection