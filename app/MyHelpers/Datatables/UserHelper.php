<?php

namespace App\MyHelpers\Datatables;

use Illuminate\Support\Str;
use DataTables;
use App\User;

class UserHelper
{
	/**
	 * Returns edited json string of user's account data
	 * This method is used in App\Http\Controllers\Users\ViewController::json_all()
	 * 
	 * @return string
	 */
	public static function json_all()
	{
		$source = (new User)->users(true);

		$json = DataTables::of($source)
			->editColumn('roles', function ($user) {
				$labelColor = 'bg-primary';
				switch ($user->roles) {
					case 'root' : $labelColor = ' bg-purple';  break;
					case 'admin': $labelColor = ' bg-red';     break;
					case 'user' : $labelColor = ' bg-primary'; break;
					default     : $labelColor = ' bg-primary'; break;
				}
				$out = '<span class="label'.$labelColor.'"><small>'.$user->roles.'</small></span>';

				return $out;
			})
			->addColumn('action', function ($user) {
				$rolesButton = '<li><a id="btn-action-change_roles" data-action="'.route('home.users.change_roles')
					.'" href="#" '
					.'onclick="change_roles('.$user->id.')">'
					.'<span><i class="fa fa-adjust"></i> Level</span></a></li>';
				$useRolesButton = false;

				$disabledAction = '<button type="button" class="btn btn-xs btn-primary btn-red btn-flat btn-responsive disabled">'
						.'<i class="fa fa-gear"></i> Kelola</button>';
				$action = null;
				if ($user->roles === 'user' && auth()->user()->roles === 'admin') {
					$useRolesButton = false;
				}
				elseif (($user->roles === 'user' || $user->roles === 'admin') && auth()->user()->roles === 'root') {
					$useRolesButton = true;
				}
				$action = '<div class="btn-group">'
					.'<button type="button" class="btn btn-xs btn-primary btn-flat btn-responsive dropdown-toggle" '
					.'data-toggle="dropdown" aria-expanded="false">'
					.'<i class="fa fa-gear"></i> Kelola</button>'
					.'<ul class="dropdown-menu" role="menu">'
					// btn-action-edit
					.'<li><a id="btn-action-edit" href="#" data-toggle="modal" data-target="#modal-edit"'
					.'onclick="edit('.$user->id.')">'
					.'<span><i class="fa fa-pencil"></i> Edit data</span></a></li>'
					// btn-action-renew
					.'<li><a id="btn-action-renew" href="#" data-toggle="modal" data-target="#modal-renew"'
					.'onclick="renew('.$user->id.')">'
					.'<span><i class="fa fa-retweet"></i> Renew</span></a></li>'
					.($useRolesButton === true ? $rolesButton : null)
					// btn-action-remove
					.'<li><a id="btn-action-remove" data-action="'.route('home.users.remove').'" href="#" '
					.'onclick="remove('.$user->id.')">'
					.'<span class="text-danger"><i class="fa fa-trash"></i> Hapus</span></a></li>'
					.'</ul></div>';

				if (($user->roles === 'root' || $user->roles === 'admin') && auth()->user()->roles === 'admin') {
					$action = $disabledAction;
				}
				return $action;
			})
			->rawColumns(['roles', 'action'])
			->toJson();

		return $json;
	}
}