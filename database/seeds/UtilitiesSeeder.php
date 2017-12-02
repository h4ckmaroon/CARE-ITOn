<?php

use Illuminate\Database\Seeder;

class UtilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utilities')->insert([
            'username' => 'careiton',
            'password' => bcrypt('c4r31t0n'),
            'clientId' => 'a0d5b46d-733c-42b8-a1e8-6ebce6d8e4ca',
            'clientSecret' => 'kS4kS3yK7kY8pK8rE6pM7mA2oW6lL6xH5aP7cQ5oT1gA4dG6xY',
            'oauth' => 'https://www.getpostman.com/oauth2/callback'
        ]);
    }
}
