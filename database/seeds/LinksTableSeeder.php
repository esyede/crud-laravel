<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$links = [
    		[
    			'type' => 'download',
    			'url' => 'https://chrome.google.com/downloads/amd64?standalone=1',
    			'name' => 'Google Chrome 72.0.3626.121 (64 bit)',
    			'created_at' => now(),
    			'updated_at' => now()
    		],
    		[
    			'type' => 'download',
    			'url' => 'https://chrome.google.com/downloads/i386?standalone=1',
    			'name' => 'Google Chrome 72.0.3626.121 (32 bit)',
    			'created_at' => now(),
    			'updated_at' => now()
    		]
    	];
        DB::table('links')->insert($links);

        $links = [
    		[
    			'type' => 'tutorial',
    			'url' => 'https://youtube.com/watch?v=gffWE5DfdcfCD4VnNa',
    			'name' => 'Dropship Ninja: Setelan Awal Dropship Ninja',
    			'created_at' => now(),
    			'updated_at' => now()
    		],
    		[
    			'type' => 'tutorial',
    			'url' => 'https://youtube.com/watch?v=d33E5D32dfdD4VnNa',
    			'name' => 'Dropship Ninja: Scraping Bukalapak dengan Dropship Ninja',
    			'created_at' => now(),
    			'updated_at' => now()
    		]
    	];
        DB::table('links')->insert($links);
    }
}
