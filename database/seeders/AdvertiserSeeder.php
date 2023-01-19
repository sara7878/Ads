<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Advertiser;

class AdvertiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Advertiser::create([
            'fname' => 'sara',
            'lname' => 'mohamed',
            'email' => 'sara.mahamed7878@gmail.com',
        ]);
    }
}
