<?php

use Illuminate\Database\Seeder;

class CatalogProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding root product catalogs
        $limit = 10;
        $prodcat = [];
        for ($i = 0; $i < $limit; $i++) { 
            $prodcat[$i] = ['product_id' => $i + 1, 'catalog_id' => 1];
        }
        DB::table('catalog_product')->insert($prodcat);

        // Seeding admin product catalogs
        $limit = 10;
        $prodcat = [];
        for ($i = 10; $i < $limit; $i++) { 
            $prodcat[$i] = ['product_id' => $i + 1, 'catalog_id' => 2];
        }
        DB::table('catalog_product')->insert($prodcat);

        // Seeding fake user product catalogs
        $limit = $limit + 10;
        $prodcat = [];
        for ($i = 20; $i < $limit; $i++) { 
            $prodcat[$i] = ['product_id' => $i + 1, 'catalog_id' => 3];
        }
        DB::table('catalog_product')->insert($prodcat);
    }
}
