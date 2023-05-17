<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            "id" => 1000,
            "ci" => "1000",
            "name" => "Alejandra Murillo",
            "phone" => "71234567",
            "genre" => "F",
        ]);
        DB::table('usuarios')->insert([
            "id" => 1001,
            "ci" => "1001",
            "name" => "Paty Perez",
            "phone" => "71234567",
            "genre" => "F",
        ]);
        DB::table('usuarios')->insert([
            "id" => 1002,
            "ci" => "1002",
            "name" => "Ronald Perez",
            "phone" => "71234567",
            "genre" => "M",
        ]);
    }
}