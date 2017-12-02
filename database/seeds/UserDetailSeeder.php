<?php

use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_detail')->insert([
            'userId' => 1,
            'firstName' => 'Aira Marie',
            'middleName' => 'Barrameda',
            'lastName' => 'Coronado',
            'contactNo' => '09195436694',
            'email' => 'hongkaira@gmail.com'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 2,
            'firstName' => 'Coleen',
            'middleName' => 'Virrey',
            'lastName' => 'Vivas',
            'contactNo' => '',
            'email' => ''
        ]);
        DB::table('user_detail')->insert([
            'userId' => 3,
            'firstName' => 'Mark Julius',
            'middleName' => 'Reyes',
            'lastName' => 'Uy',
            'contactNo' => '',
            'email' => ''
        ]);
        DB::table('user_detail')->insert([
            'userId' => 4,
            'firstName' => 'Paul Andrei',
            'middleName' => 'Navarro',
            'lastName' => 'Cruz',
            'contactNo' => '',
            'email' => ''
        ]);
        DB::table('user_detail')->insert([
            'userId' => 5,
            'firstName' => 'John',
            'middleName' => 'Rodriguez',
            'lastName' => 'Romasanta',
            'contactNo' => '',
            'email' => ''
        ]);
        DB::table('user_detail')->insert([
            'userId' => 6,
            'firstName' => 'Gendy',
            'middleName' => '',
            'lastName' => 'Lopez',
            'contactNo' => '',
            'email' => ''
        ]);
        DB::table('user_detail')->insert([
            'userId' => 7,
            'firstName' => 'Nhell Anthony',
            'middleName' => '',
            'lastName' => 'Erni',
            'contactNo' => '',
            'email' => ''
        ]);
    }
}
