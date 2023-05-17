<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductModel;
use DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            "id" => 1000,
            "name" => "Manzana",
            "price" => 10,
        ]);
        DB::table('products')->insert([
            "id" => 1001,
            "name" => "Pera",
            "price" => 105,
        ]);
        DB::table('products')->insert([
            "id" => 1002,
            "name" => "Banana",
            "price" => 75.5,
        ]);
    }
}