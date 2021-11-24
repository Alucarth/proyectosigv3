<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $package = Package::create(['nombre' => 'PAQUETE 1','porcentaje' => '50','descripcion' => 'PAQUETE PARA HOMBRES', 'estado' => 'ACTIVO']);
        $package = Package::create(['nombre' => 'PAQUETE 2','porcentaje' => '70','descripcion' => 'PAQUETE PARA MUJERES', 'estado' => 'ACTIVO']);
        $package = Package::create(['nombre' => 'PAQUETE 3','porcentaje' => '90','descripcion' => 'PAQUETE PARA MADRES SOLTERAS', 'estado' => 'ACTIVO']);
    }
}
