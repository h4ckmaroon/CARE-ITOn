<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UtilitiesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserDetailSeeder::class);
        $this->call(ItemCategorySeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(ItemRateSeeder::class);
    }
}
