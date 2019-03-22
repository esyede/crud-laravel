<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\SiteSetting;

class Catalog extends Model
{
	protected $fillable = [
		'user_id',
		'name',
		'description',
		'created_at',
		'updated_at'
	];

	public function add(array $data)
	{
		$this->user_id     = $data['user_id'];
		$this->name        = $data['name'];
        $this->description = $data['description'];
        $this->created_at  = now();
        $this->updated_at  = now();

        return $this->save();
	}


	public function edit(array $data)
	{
		$record              = $this->find($data['id']);
        $record->name        = $data['name'];
        $record->description = $data['description'];
        $record->updated_at  = now();

        return $record->save();
	}

	public function allByUser(int $id)
	{
		return $this->select()->where('user_id', '=', $id)->get();
	}


	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function products()
	{
		return $this->hasMany('App\Product');
	}
}