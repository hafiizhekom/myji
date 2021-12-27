<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@shopmyji.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
