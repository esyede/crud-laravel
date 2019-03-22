<?php

namespace App\Observers;
use App\Catalog;
use App\User;

class UserObserver
{
    public function deleting(User $user)
    {
    	$user->catalogs()->delete();
    	$user->products()->delete();
    }
}
