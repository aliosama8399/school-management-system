<?php

namespace Database\Seeders;

use App\Models\Type_Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type__bloods')->delete();
        $bs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
        foreach ($bs as $b) {
            Type_Blood::create(['Name' => $b]);
        }


    }
}
