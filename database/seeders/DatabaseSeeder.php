<?php

namespace Database\Seeders;


use ClassroomTableSeeder;
use GradeSeeder;
use Illuminate\Database\Seeder;
use ParentsTableSeeder;
use SectionsTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use StudentsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
        $this->call(BloodTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(NationalityTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(ParentsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
