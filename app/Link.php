<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function add(array $data)
	{
		$this->type       = $data['type'];
		$this->url        = $data['url'];
		$this->name       = $data['name'];
        $this->created_at = now();
        $this->updated_at = now();

        return $this->save();
	}

	public function edit(array $data)
	{
		$record             = $this->find($data['id']);
		$record->type       = $data['type'];
        $record->url        = $data['url'];
		$record->name       = $data['name'];
        $record->updated_at = now();

        return $record->save();
	}

	public function remove(int $id)
	{
		return $this->findOrFail($id)->delete();
	}


	public function allDownload()
	{
		return $this->select()->where('type', '=', 'download')->orderBy('updated_at')->get();
	}

	public function allTutorial()
	{
		return $this->select()->where('type', '=', 'tutorial')->orderBy('updated_at')->get();
	}
}
