<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class SellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sells')->insert([
            "id" => 2000,
            "observation" => "Venta 1",
            "total" => 125,
            "id_user" => 1000,
        ]);

        DB::table('detail_sells')->insert([
            "id" => 1500,
            "id_sell" => 2000,
            "id_product" => 1000,
            "unit_price" => 10,
            "amount" => 2,
            "subtotal" => 20,
        ]);
        DB::table('detail_sells')->insert([
            "id" => 1501,
            "id_sell" => 2000,
            "id_product" => 1001,
            "unit_price" => 105,
            "amount" => 1,
            "subtotal" => 105,
        ]);
    }
}