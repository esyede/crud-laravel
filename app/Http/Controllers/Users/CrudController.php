<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use DataTables;

use App\Http\Requests\Users\UsersAdd;
use App\Http\Requests\Users\UsersEdit;
use App\Http\Requests\Users\UsersRenew;
use App\Http\Requests\Users\UsersChangeRole;
use App\Http\Requests\Users\UsersRemove;

use App\User;
use App\Catalog;
// use Ramsey\Uuid\Uuid;

class CrudController extends Controller
{
	/**
	 * Create new controller instance
	 */
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function add(UsersAdd $request)
	{
		$data = $request->validated();
		$data['password'] = bcrypt($data['password']);
		$data['expired_at'] = now()->addMonths($data['expired_at']);
		$operation = (new User)->add($data);
		$json = [
			'success'  => ($operation !== false),
			'messages' => 'Akun '.$data['name'].($operation !== false ? ' berhasil' : ' gagal').' ditambahkan'
		];
		
		return response()->json($json);
	}


	public function edit(UsersEdit $request)
	{
		$json = null;
		$data = $request->validated();
		if (filled($data['expired_at'])) {
			$data['expired_at'] = strpos(' ', trim($data['expired_at']))
				? $data['expired_at']
				: $data['expired_at'].' '.explode(' ', now())[1];
		}
		if (filled($data['password'])) {
			$data['password'] = bcrypt($data['password']);
		}

		$operation = (new User)->edit($data);
		$json = [
			'success'  => ($operation !== false),
			'messages' => 'Akun '.$data['name'].($operation !== false ? ' berhasil' : ' gagal').' diperbarui'
		];
		
		return response()->json($json);
	}

	public function editJson(Request $request)
	{
		abort_if(!in_array(auth()->user()->roles, ['admin', 'root']), 403);
		$data = $request->validate(['id' => 'bail|required|numeric']);

		$user = User::findOrFail($data['id']);
		$user->where('roles', '<>', 'root');
		if (auth()->user()->roles === 'admin') {
			$user->where('roles', '<>', 'admin');
		}

		return response()->json($user);
	}


	public function renew(UsersRenew $request)
	{
		$data = $request->validated();
		$duration = $data['expired_at'];
		$user = User::findOrFail($data['id']);
		$data['expired_at'] = Carbon::parse($user->expired_at)->addMonths($data['expired_at']);

		$operation = (new User)->renew($data);
		$json = [
			'success'  => ($operation !== false),
			'messages' => 'Tambah masa aktif '.$user->name
				.($operation !== false ? ' selama '.$duration.' bulan telah berhasil' : ' gagal')
		];

		return response()->json($json);
	}


	public function change_roles(UsersChangeRole $request)
	{
		$data = $request->validated();
		$user = User::findOrFail($data['id']);
		$data['roles'] = $user->roles === 'admin' ? 'user' : 'admin';
		$operation = (new User)->change_roles($data);

		$json = [
			'success'  => ($operation !== false),
			'messages' => 'Level '.$user->name
				.($operation !== false ? ' berhasil' : ' gagal').' diubah menjadi '.$data['roles']
		];

		return response()->json($json);
	}


	public function remove(UsersRemove $request)
	{
		$data = $request->validated();
		$user = User::find($data['id']);
		$delprod = $user->products();
		$prodDeleted = false;
		if ($delprod->count() < 1) {
			$prodDeleted = true;
		}
        else {
        	$prodDeleted = $delprod->delete();
        }
		$delcat = $user->catalogs();
		$catDeleted = false;
		if ($delcat->count() < 1) {
			$catDeleted = true;
		}
        else {
        	$catDeleted = $prodDeleted && $delcat->delete();
        }
        $operation = $catDeleted && $user->delete();
		$json = [
			'success'  => ($operation !== false),
			'messages' => 'Anggota '.($operation !== false ? ' berhasil' : ' gagal').' dihapus'
		];

		return response()->json($json);
	}


	public function swap(Request $request)
	{
		abort_if(!in_array(auth()->user()->roles, ['admin', 'root']), 403);
        
        $operation = false;
        $users = User::select(['id', 'expired_at'])
            ->where('roles', '=', 'user')
            ->orderBy('id');
         // Tidak ada user sama sekali
        if ($users->count() < 1) {
            $json = ['success' => true, 'messages' => 'Belum ada user untuk disapu'];

        	return response()->json($json);
        }
        // Ada user
        else {
            $users = $users->get();
            $userIds = [];
            // Ambil user id yang tanggalnya kadaluwarsa
            foreach ($users as $user) {
                if (Carbon::parse($user->expired_at)->lessThan(now())) {
                    $userIds[] = $user->id;
                }
            }
            // Tidak ada user yang tanggalnya kadaluwarsa
            if (blank($userIds)) {
                $json = ['success' => true, 'messages' => 'Belum ada lagi akun yang kadaluwarsa'];
        		return response()->json($json);
            }
            // Ada akun yang kadaluwarsa
            else {
            	// Hapus semua user yang kadaluwarsa
                foreach ($userIds as $id) {
    				$user = User::find($id);
    				$delprod = $user->products();
    				$prodDeleted = false;
    				if ($delprod->count() < 1) {
    					$prodDeleted = true;
    				}
    		        else {
    		        	$prodDeleted = $delprod->delete();
    		        }
    				$delcat = $user->catalogs();
    				$catDeleted = false;
    				if ($delcat->count() < 1) {
    					$catDeleted = true;
    				}
    		        else {
    		        	$catDeleted = $prodDeleted && $delcat->delete();
    		        }
    		        $operation = $catDeleted && $user->delete();
                }
            }
        }

        $json = [
        	'success'  => ($operation !== false),
        	'messages' => 'Semua akun yang kadaluwarsa'.($operation !== false ? ' berhasil': ' gagal').' disapu'
        ];

        return response()->json($json);
	}
}
