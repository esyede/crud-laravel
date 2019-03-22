<?php

use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding site settings table
    	DB::table('site_settings')->insert([
    		[
    			'site_title'        => 'Dropship Ninja',
                'registration_gate' => 'close',
                'max_login'         => 3,
    			'created_at'        => now(),
    			'updated_at'        => now()
    		]
    	]);
    }
}