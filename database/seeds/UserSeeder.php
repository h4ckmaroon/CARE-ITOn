<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'amcoronado',
            'password' => bcrypt('p@ssw0rd'),
            'userType' => 1,
            'accountNo' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'cvivas',
            'password' => bcrypt('p@ssw0rd'),
            'userType' => 1,
            'accountNo' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'mjuy',
            'password' => bcrypt('p@ssw0rd'),
            'userType' => 1,
            'accountNo' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'pacruz',
            'password' => bcrypt('p@ssw0rd'),
            'userType' => 1,
            'accountNo' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'jromasanta',
            'password' => bcrypt('p@ssw0rd'),
            'userType' => 1,
            'accountNo' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'glopez',
            'password' => bcrypt('p@ssw0rd'),
            'userType' => 2,
            'accountNo' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => 'naerni',
            'password' => bcrypt('p@ssw0rd'),
            'userType' => 2,
            'accountNo' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
