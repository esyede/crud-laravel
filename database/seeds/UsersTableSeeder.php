<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create rood account
        $users = [
            'name'     => 'Root',
            'username' => 'root',
            'roles'    => 'root',
        ];

        $users += [
    		'username_verified_at' => now(),
            'password'             => bcrypt('password'),
            'expired_at'           => now()->addYears(10),
			'created_at'           => now(),
			'updated_at'           => now(),
        ];
        // Seed
        DB::table('users')->insert($users);

        // Seeding admin account
        $users['name']     = 'Admin';
        $users['username'] = 'admin';
        $users['roles']    = 'admin';
        DB::table('users')->insert($users);
        
        // Seeding fake user account
        $users['name']     = 'User';
        $users['username'] = 'user';
        $users['roles']    = 'user';
        // Seed
        DB::table('users')->insert($users);
    }
}
