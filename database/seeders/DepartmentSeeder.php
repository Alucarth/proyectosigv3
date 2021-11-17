<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $department = Department::create(['nombre' => 'Chuquisaca','sigla' => 'CH','codigo_INE' => '01']);
        $department = Department::create(['nombre' => 'La Paz','sigla' => 'LP','codigo_INE' => '02']);
        $department = Department::create(['nombre' => 'Cochabamba','sigla' => 'CB','codigo_INE' => '03']);
        $department = Department::create(['nombre' => 'Oruro','sigla' => 'OR','codigo_INE' => '04']);
        $department = Department::create(['nombre' => 'Potosí','sigla' => 'PT','codigo_INE' => '05']);
        $department = Department::create(['nombre' => 'Tarija','sigla' => 'TJ','codigo_INE' => '06']);
        $department = Department::create(['nombre' => 'Santa Cruz','sigla' => 'SC','codigo_INE' => '07']);
        $department = Department::create(['nombre' => 'Beni','sigla' => 'BE','codigo_INE' => '08']);
        $department = Department::create(['nombre' => 'Pando','sigla' => 'PD','codigo_INE' => '09']);

    }
}
