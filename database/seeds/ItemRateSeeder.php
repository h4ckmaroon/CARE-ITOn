<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class ItemRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item')->insert([
            'itemId' => 1,
            'rate' => 9.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 2,
            'rate' => 5.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 3,
            'rate' => 3.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 4,
            'rate' => 5.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 5,
            'rate' => 5.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 6,
            'rate' => 25.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 7,
            'rate' => 15.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 8,
            'rate' => 30.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 9,
            'rate' => 10.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 10,
            'rate' => 10.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 11,
            'rate' => 10.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 12,
            'rate' => 10.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 13,
            'rate' => 5.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 14,
            'rate' => 50.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 15,
            'rate' => 30.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 16,
            'rate' => 30.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('item')->insert([
            'itemId' => 17,
            'rate' => 20.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
