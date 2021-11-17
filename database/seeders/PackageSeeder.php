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
        $package = Package::create(['nombre' => 'Paquete 1','porcentaje' => '50','descripcion' => 'Paquete para Hombres', 'estado' => 'ACTIVO']);
        $package = Package::create(['nombre' => 'Paquete 2','porcentaje' => '70','descripcion' => 'Paquete para Mujeres', 'estado' => 'ACTIVO']);
        $package = Package::create(['nombre' => 'Paquete 3','porcentaje' => '90','descripcion' => 'Paquete para Madres Solteras', 'estado' => 'ACTIVO']);
    }
}
