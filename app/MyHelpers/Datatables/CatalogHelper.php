<?php

namespace App\MyHelpers\Datatables;

use Illuminate\Support\Str;
use DataTables;
use App\Catalog;
use App\Product;

class CatalogHelper
{
	/**
	 * Returns edited json string of user's catalogs
	 * This method is used in App\Http\Controllers\Catalogs\ViewController::json_all()
	 * 
	 * @return string
	 */
	public static function json_all()
	{
		$source = (new Catalog)->allByUser(auth()->user()->id);

		$json = DataTables::of($source)
			->editColumn('name', function ($catalog) {
				return '<a href="'.route('home.catalogs.one', ['id' => $catalog->id]).'">'.
					'<strong>'.$catalog->name.'</strong></a>';
			})
			->addColumn('action', function ($catalog) {
				return '<a href="'.route('home.catalogs.one', ['id' => $catalog->id])
					.'" class="btn btn-social-icon btn-success btn-sm btn-flat btn-responsive">'
					.'<i class="fa fa-list"></i></a>'

					.'<button id="btn-action-edit" '
					.'class="btn btn-social-icon btn-primary btn-sm btn-flat btn-responsive"'
					.' data-toggle="modal" data-target="#modal-edit" onclick="edit('.$catalog->id.')">'
					.'<i class="fa fa-pencil"></i></button>'

					.'<button id="btn-action-remove" '
					.'class="btn btn-social-icon btn-danger btn-sm btn-flat btn-responsive" '
					.'data-action="'.route('home.catalogs.remove').'" onclick="remove('.$catalog->id.')">'
					.'<i class="fa fa-trash"></i></button>';
			})
			->rawColumns(['name', 'action'])
			->toJson();

		return $json;
	}

	/**
	 * Returns edited json string of user's products in particular catalog
	 * This method is used in App\Http\Controllers\Catalogs\ViewController::json_one()
	 * 
	 * @return string
	 */
	public static function json_one(int $id)
	{
		$source = (new Product)->allByCatalog($id);

		$json = DataTables::of($source)
			//! Gambar
			->editColumn('image', function (Product $product) {
				// Gunakan gambar dari cloud jika ada
				$image = !blank($product->custom_image) ? $product->custom_image : $product->image;
				$image = '<img src="'.$image.'" width="100" height="100" '
					.'class="img img-responsive" style="margin-right: 2px; margin-left: 2px;" alt="image"/>';

				return $image;
			})
			//! Nama
			->editColumn('name', function ($product) {
				// Tombol aksi
				$name = '<small class="text text-primary"><strong>'.$product->name.'</strong></small>';
				$action = '<div class="btn-group">'
					.'<button type="button" class="btn btn-sm btn-primary btn-flat btn-responsive dropdown-toggle" '
					.'data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i> Kelola</button>'
					.'<ul class="dropdown-menu" role="menu">'
					// btn-dropdown-edit-data
					.'<li><a href="'.route('home.products.edit', ['id' => $product->id]).'">'
					.'<span><i class="fa fa-pencil"></i> Edit data</span></a></li>'
					// btn-dropdown-set-margin
					.'<li><a href="#" data-toggle="modal" data-target="#modal-set-margin" '
					.'class="product-id" product-id="'.$product->id.'">'
					.'<span><i class="fa fa-money"></i> Set margin</span></a></li>'
					// btn-dropdown-cek-supplier
					.'<li><a href="'.$product->link.'" target="_blank">'
					.'<span><i class="fa fa-eye"></i> Cek supplier</span></a></li>'
					// btn-dropdown-remove
					.'<li><a id="btn-action-remove" href="#" onclick="remove('.$product->id.')">'
					.'<span class="text-danger"><i class="fa fa-trash"></i> Hapus</span></a></li>'
					.'</ul></div>';

				return  $name.'<hr>'.$action;
			})
			//! Harga Barang
			->editColumn('price', function ($product) {
				$out  = '<small class="text-muted">';
				$out .= 'Supplier:<br><span class="label bg-primary">Rp. '.$product->price.'</span><br>';
				$out .= 'Margin:<br><span class="label bg-green">Rp. '.$product->margin.'</span>';
				$out .= '</small>';

				return $out;
			})
			//! Berat
			->editColumn('weight', function ($product) {
				$out = '<span class="badge bg-maroon"><small>'.$product->weight.'gr</small></span>';

				return $out;
			})
			//! Supplier
			->editColumn('supplier', function ($product) {
				$out = '<small class="text-primary"><strong>'.$product->supplier.'</strong></small>';

				return $out;
			})
			//! Frame
			->editColumn('custom_image', function ($product) {
				$custom = !blank($product->custom_image)
					? '<span class="text-green"><i class="fa fa-check"></i></span>'
					: '<span class="text-red"><i class="fa fa-close"></i></span>';

				return $custom;
			})
			//! Status tersedia
			->editColumn('status', function ($product) {
				$status = $product->status == 'exists'
					? '<span class="text-green"><i class="fa fa-check"></i></span>'
					: '<span class="text-red"><i class="fa fa-close"></i></span>';

				return $status;
			})
			//! Kategori dari marketplace
			->editColumn('mp_categories', function ($product) {
				$mpcat = array_map('trim', preg_split('/[,;|]/', $product->mp_categories, null, PREG_SPLIT_NO_EMPTY));
				$mpcat = (array) $mpcat;
				$out = null;
				foreach ($mpcat as $val) {
					$out .= '<span class="badge bg-teal"><small>'.$val.'</small></span> ';
				}

				return $out;
			})
			//! Marketplace sumber data
			->editColumn('mp_name', function ($product) {
				$bgcolor = 'bg-red';
				switch ($product->mp_name) {
					case 'bukalapak':  $bgcolor = 'bg-maroon';  break;
					case 'jakmall':    $bgcolor = 'bg-purple';  break;
					case 'shopee':     $bgcolor = 'bg-orange';  break;
					case 'tokopedia':  $bgcolor = 'bg-green';   break;
					default:           $bgcolor = 'bg-red';     break;
				}
				$out = '<a href="'.$product->link.'" class="badge '.$bgcolor
					.'" target="_blank"><small>'.ucfirst($product->mp_name).'</small></a>';

				return $out;
			})
			//! Disinkron
			->editColumn('updated_at', function ($product) {
				$out = '<small class="text-muted">'.$product->updated_at.'</small>';

				return $out;
			})
			->rawColumns([
				 'image', 'name','price', 'weight', 'supplier',
				'custom_image', 'status', 'mp_categories', 'mp_name', 'updated_at'
			])
			->toJson();

		return $json;
	}
}