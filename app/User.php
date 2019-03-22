<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'username_verified_at',
        'password', 'roles', 'expired_at', 'roles',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function add(array $data)
    {
        $this->name = $data['name'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->expired_at = $data['expired_at'];
        $this->created_at = now();
        $this->updated_at = now();

        return $this->save();
    }

    public function edit(array $data)
    {
        $record = $this->findOrFail($data['id']);
        $record->name = $data['name'];
        if (isset($data['username'])) {
            $record->username = $data['username'];
        }
        if (isset($data['password'])) {
            $record->password = $data['password'];
        }
        if (isset($data['expired_at'])) {
            $record->expired_at = $data['expired_at'];
        }
        $record->updated_at = now();

        return $record->save();
    }

    public function renew(array $data)
    {
        $record = $this->findOrFail($data['id']);
        $record->expired_at = $data['expired_at'];
        $record->updated_at = now();

        return $record->save();
    }

    public function change_roles(array $data)
    {
        $record = $this->findOrFail($data['id']);
        $record->roles = $data['roles'];
        $record->updated_at = now();

        return $record->save();
    }

    /**
     * Get all users
     *
     * @param  boolean $showAdmins
     * @param  boolean $showRoots
     * @return object
     */
    public function users(bool $showAdmins = false, bool $showRoots = false)
    {
        $records = $this->select();
        if ($showAdmins === false) {
            $records->where('roles', '<>', 'admin');
        }
        if ($showRoots === false) {
            $records->where('roles', '<>', 'root');
        }

        return $records->orderBy('id')->get();
    }

    public function catalogs()
    {
        return $this->hasMany('App\Catalog');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}