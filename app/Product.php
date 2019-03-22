<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		//
	];


	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function catalog()
	{
		return $this->belongsTo('App\Catalog');
	}


	public function add(array $data)
	{
		//
	}


	public function edit(array $data)
	{
		//
	}

	public function list()
	{
		$list = $this->join('catalog_product', 'products.id', '=', 'catalog_product.product_id')
			->join('catalogs', 'catalogs.id', '=', 'catalog_product.catalog_id')
			->select('products.id', 'catalogs.id as catalog_id','products.*', 'catalogs.name as catalog_name')
			->latest('id')
			->get();

		return $list;
	}


	public function allByCatalog(int $id)
	{
		$data = $this->select([
			'products.id',
			'products.link',
			'products.name',
			'products.price',
			'products.image',
			'products.stock',
			'products.weight',
			'products.condition',
			'products.description',
			'products.assurance',
			'products.courier',
			'products.margin',
			'products.supplier',
			'products.status',
			'products.custom_image',
			'products.mp_name',
			'products.mp_categories',
			'products.variant',
			'products.created_at',
			'products.updated_at',
			'catalogs.name as catalog_name'
		])
		->where('products.user_id', '=', auth()->user()->id)
		->where('catalogs.id', '=', $id)
		->join('catalog_product', 'products.id', '=', 'catalog_product.id')
		->join('catalogs', 'catalogs.id', '=', 'catalog_product.catalog_id')
		->latest('id')
		->get();

		return $data;
	}
}
