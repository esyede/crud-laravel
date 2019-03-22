<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 10;
        $product = [];
        $name = [
            'Tas Wanita CxxNL Original Thailand Murah',
            'Kemeja Pria Batik All Size Bahan Sutra',
            'Kaos Polo 3Second Original'
        ];

        $condition = ['new', 'used'];
        $mpname = ['bukalapak', 'tokopedia', 'jakmall', 'shopee'];
        $status = ['exists', 'deleted'];

        $records = [
                'user_id'       => 1,
                'catalog_id'    => 1,
                'link'          => 'https://www.bukalapak.com/p/fashion-wanita/tas-wanita/'
                                 .'hand-bags/13d7cn0-jual-tas-wanita-cxxnel-lidah',
                'name'          => $name[0],
                'price'         => rand(100000, 200000),
                'image'         => asset('images/test.png'),
                'custom_image'  => null,
                'mp_name'       => $mpname[0],
                'mp_categories' => 'kemeja, kaos anak, gamis',
                'stock'         => 10,
                'weight'        => 600,
                'condition'     => $condition[0],
                'description'   => $name[0].' murah dengan kualitas bagus',
                'assurance'     => 'no',
                'courier'       => serialize(['jner', 'jtr', 'tikir']),
                'supplier'      => 'Venita Olshop',
                'status'        => $status[0],
                'margin'        => 100,
                'created_at'    => now(),
                'updated_at'    => now()
            ];

        // Seeding root products
        $product = [];
        for ($i = 0; $i < $limit; $i++) {
            shuffle($name);
            shuffle($condition);
            shuffle($mpname);
            shuffle($status);
            $product[$i] = $records;
        }
        DB::table('products')->insert($product);
        
        // Seeding admin products
        $limit = $limit + 10;
        $product = [];
        $records['catalog_id'] = 2;
        $records['user_id'] = 2;
        for ($i = 10; $i < $limit; $i++) { 
            shuffle($name);
            shuffle($condition);
            shuffle($mpname);
            shuffle($status);
            // $product[$i]['user_id'] = 2;
            // $product[$i]['catalog_id'] = 2;
            $product[$i] = $records;
        }
        DB::table('products')->insert($product);

        // Seeding fake user products
        $limit = $limit + 10;
        $product = [];
        $records['catalog_id'] = 3;
        $records['user_id'] = 3;
        for ($i = 20; $i < $limit; $i++) { 
            shuffle($name);
            shuffle($condition);
            shuffle($mpname);
            shuffle($status);
            $product[$i] = $records;
            // $product[$i]['user_id'] = 3;
            // $product[$i]['catalog_id'] = 3;
        }
        DB::table('products')->insert($product);
    }
}
