<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SiteSettingsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CatalogsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);        
        $this->call(CatalogProductTableSeeder::class);
        $this->call(LinksTableSeeder::class);
        $this->call(PreferencesTableSeeder::class);
    }
}
