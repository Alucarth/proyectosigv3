<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            OfficialSeeder::class,
            CareerSeeder::class,
            DepartmentSeeder::class,
            PackageSeeder::class,
            ProblemSeeder::class,
            SocietySeeder::class        
        ]);
    }
}
