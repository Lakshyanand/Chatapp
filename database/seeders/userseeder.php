<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userdetails')->insert(['name' => 'Lakshya', 'email' => 'laksh.anand2299@gmail.com', 'password' => Hash::make('lakshya'),'role' => 'Admin']);
    }
}
