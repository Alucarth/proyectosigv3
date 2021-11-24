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
        $department = Department::create(['nombre' => 'CHUQUISACA','sigla' => 'CH','codigo_INE' => '01']);
        $department = Department::create(['nombre' => 'LA PAZ','sigla' => 'LP','codigo_INE' => '02']);
        $department = Department::create(['nombre' => 'COCHABAMBA','sigla' => 'CB','codigo_INE' => '03']);
        $department = Department::create(['nombre' => 'ORURO','sigla' => 'OR','codigo_INE' => '04']);
        $department = Department::create(['nombre' => 'POTOSÍ','sigla' => 'PT','codigo_INE' => '05']);
        $department = Department::create(['nombre' => 'TARIJA','sigla' => 'TJ','codigo_INE' => '06']);
        $department = Department::create(['nombre' => 'SANTA CRUZ','sigla' => 'SC','codigo_INE' => '07']);
        $department = Department::create(['nombre' => 'BENI','sigla' => 'BE','codigo_INE' => '08']);
        $department = Department::create(['nombre' => 'PANDO','sigla' => 'PD','codigo_INE' => '09']);

    }
}
