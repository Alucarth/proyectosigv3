<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Problem;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $problem = Problem::create(['nombre' => 'FALTA DE EXPERIENCIA']);
        $problem = Problem::create(['nombre' => 'PROBLEMAS CON EL HORARIO LABORAL']);
        $problem = Problem::create(['nombre' => 'CUIDADO DE ADULTO MAYOR']);
        $problem = Problem::create(['nombre' => 'CUIDADO DE NIÑOS EN ETAPA INICIAL']);
        $problem = Problem::create(['nombre' => 'OTROS']);        
    }
}
