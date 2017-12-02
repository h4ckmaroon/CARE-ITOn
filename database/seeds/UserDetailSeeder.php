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
            'email' => 'hongkaira@gmail.com',
            'photo' => 'pics/steve.jpg'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 2,
            'firstName' => 'Coleen',
            'middleName' => 'Virrey',
            'lastName' => 'Vivas',
            'contactNo' => '09054090523',
            'email' => 'cvivas@indra.es',
            'photo' => 'pics/steve.jpg'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 3,
            'firstName' => 'Mark Julius',
            'middleName' => 'Reyes',
            'lastName' => 'Uy',
            'contactNo' => '09984123460',
            'email' => 'mjuy@pup.edu.ph',
            'photo' => 'pics/steve.jpg'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 4,
            'firstName' => 'Paul Andrei',
            'middleName' => 'Navarro',
            'lastName' => 'Cruz',
            'contactNo' => '09054090523',
            'email' => 'pacruz@indra.es',
            'photo' => 'pics/steve.jpg'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 5,
            'firstName' => 'John',
            'middleName' => 'Rodriguez',
            'lastName' => 'Romasanta',
            'contactNo' => '09991231263',
            'email' => 'jromasanta@indra.es',
            'photo' => 'pics/steve.jpg'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 6,
            'firstName' => 'Gendy',
            'middleName' => '',
            'lastName' => 'Lopez',
            'contactNo' => '09279679229',
            'email' => 'glopez@fujitsu.ten',
            'photo' => 'pics/steve.jpg'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 7,
            'firstName' => 'Nhell Anthony',
            'middleName' => '',
            'lastName' => 'Erni',
            'contactNo' => '09053530500',
            'email' => 'naerni@pup.edu.ph',
            'photo' => 'pics/steve.jpg'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 8,
            'firstName' => 'Neil Angelo',
            'middleName' => '',
            'lastName' => 'Pereyera',
            'contactNo' => '09054090523',
            'email' => 'napereyra@fujitsu.ten',
            'photo' => 'pics/steve.jpg'
        ]);
        DB::table('user_detail')->insert([
            'userId' => 9,
            'firstName' => 'Zharmagne',
            'middleName' => '',
            'lastName' => 'Isorena',
            'contactNo' => '09054090523',
            'email' => 'zi@pup.edu.ph',
            'photo' => 'pics/steve.jpg'
        ]);
    }
}
