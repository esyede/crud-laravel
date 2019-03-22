<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCatalog extends Model
{
	protected $fillable = ['catalog_id', 'product_id'];


	public function add(array $data)
	{
        $this->product_id = $data['id'];
        $this->catalog_id = $data['catalog_id'];

        return $this->save();
	}


	public function edit(array $data)
	{
        $record = $this->where(['product_id' => $data['id']]);
        $record->update(['catalog_id' => $data['catalog_id']]);

        return $record;
	}
}
