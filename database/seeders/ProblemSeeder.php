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
        $problem = Problem::create(['nombre' => 'Falta de Experiencia']);
        $problem = Problem::create(['nombre' => 'Problemas con el horario laboral']);
        $problem = Problem::create(['nombre' => 'Cuidado de Adulto Mayor']);
        $problem = Problem::create(['nombre' => 'Cuidado de niños en etapa inicial']);
        $problem = Problem::create(['nombre' => 'Otros']);        
    }
}
