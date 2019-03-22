<?php

use Illuminate\Database\Seeder;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalog = [
            'user_id'     => 1,
            'name'        => 'Katalog root',
            'description' => 'Katalog default',
            'created_at'  => now(),
            'updated_at'  => now()
        ];
        // Seeding admin catalog
        DB::table('catalogs')->insert($catalog);

        // Seeding admin catalog
        $catalog['user_id'] = 2;
        $catalog['name']    = 'Katalog admin';
        DB::table('catalogs')->insert($catalog);
        // Seeding fake user catalog
        $catalog['user_id'] = 3;
        $catalog['name']    = 'Katalog user';
        DB::table('catalogs')->insert($catalog);
    }
}
