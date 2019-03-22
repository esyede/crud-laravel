<?php

namespace App\MyHelpers\Datatables;

use Illuminate\Support\Str;
use DataTables;

use App\Link;

class LinkHelper
{
	/**
	 * Returns edited json string of download and tutorials page table
	 * This method is used in:
	 *  App\Http\Controllers\Home\LinkController::allDownload() and,
	 *  App\Http\Controllers\Home\LinkController::allTutorial()
	 * 
	 * @return string
	 */
	public static function json_all($typeId)
	{
		$source = null;
		$links = new Link();
		if ($typeId == 1) {
			$source = $links->allDownload();
		}
		elseif ($typeId == 2) {
			$source = $links->allTutorial();
		}

		$json = DataTables::of($source)
			->editColumn('name', function ($link) {
				return '<a href="'.$link->url.'" target="_blank">'.$link->name.'</a>';
			})
			->addColumn('action', function ($link) use ($typeId) {
				$action = '<button id="btn-action-edit" '
					.'class="btn btn-social-icon btn-primary btn-sm btn-flat btn-responsive"'
					.' data-toggle="modal" data-target="#modal-edit" onclick="edit('.$link->id.')">'
					.'<i class="fa fa-pencil"></i></button>'

					.'<button id="btn-action-remove" '
					.'class="btn btn-social-icon btn-danger btn-sm btn-flat btn-responsive" '
					.'data-action="'.route('home.links.remove').'" onclick="remove('.$link->id.')">'
					.'<i class="fa fa-trash"></i></button>';
				if (auth()->user()->roles === 'user') {
					$action = '<a href="'.$link->url.'" target="_blank" class="btn btn-xs '
						.($typeId == 1 ? 'btn-success' : 'btn-danger').' btn-flat btn-resposive">'
						.'<i class="fa '.($typeId == 1 ? 'fa-cloud-download' : 'fa-youtube-play').'">'
						.'</i> '.($typeId == 1 ? 'Download' : 'Play').'</a>';
				}

				return $action;
			})
			->rawColumns(['name', 'action'])
			->toJson();

		return $json;
	}
}