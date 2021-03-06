<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item')->insert([
            'categoryId' => 1,
            'name' => 'White Paper',
            'description' => '',
            'rate' => 9.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 1,
            'name' => 'Colored Paper',
            'description' => '',
            'rate' => 5.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 1,
            'name' => 'Assorted Paper',
            'description' => '',
            'rate' => 3.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 2,
            'name' => 'Catsup Bottle',
            'description' => '',
            'rate' => 5.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 2,
            'name' => 'Rhum Bottle',
            'description' => '',
            'rate' => 5.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 3,
            'name' => 'Iron',
            'description' => '',
            'rate' => 25.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 3,
            'name' => 'Aluminum',
            'description' => '',
            'rate' => 15.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 3,
            'name' => 'Galvanized Sheets',
            'description' => '',
            'rate' => 30.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 4,
            'name' => 'Carton',
            'description' => '',
            'rate' => 10.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 5,
            'name' => 'Plastic Bottle',
            'description' => '',
            'rate' => 10.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 5,
            'name' => 'Genuine',
            'description' => '',
            'rate' => 10.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 1,
            'name' => 'Newspaper',
            'description' => '',
            'rate' => 10.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 1,
            'name' => 'Magazines',
            'description' => '',
            'rate' => 5.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 3,
            'name' => 'Copper',
            'description' => '',
            'rate' => 50.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 3,
            'name' => 'Brass',
            'description' => '',
            'rate' => 30.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 3,
            'name' => 'Alloy',
            'description' => '',
            'rate' => 30.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'categoryId' => 3,
            'name' => 'Scrap Metals',
            'description' => '',
            'rate' => 20.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
