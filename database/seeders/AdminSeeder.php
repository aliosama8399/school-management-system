<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name'=>'ali osama',
            'email'=>'ali@gmail.com',
            'password'=>'$2a$10$BIP.tG.DmeiCqnQ9bYZWSeencfcWiraQQbolQ6HHLTyhPSP4ECZ12',
        ]);
    }
}
