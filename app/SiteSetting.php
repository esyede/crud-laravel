<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SiteSetting extends Model
{	
	protected $fillable = ['key', 'value', 'created_at', 'updated_at'];

	protected $hiidden = [
		//
	];


	 public function renew(array $data)
    {
    	$this->site_title = $data['site_title'];
    	$this->registration_gate = $data['registration_gate'];

        return $this->update();
    }
}
