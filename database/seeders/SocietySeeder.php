<?php

namespace Database\Seeders;
use App\Models\Society;

use Illuminate\Database\Seeder;

class SocietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $society = Society::create(['nombre' => 'Comerciante Individual o Empresa Unipersonal','sigla' => 'EU']);
        $society = Society::create(['nombre' => 'Sociedad de Responsabilidad Limitada','sigla' => 'SRL']);
        $society = Society::create(['nombre' => 'Sociedad Anónima','sigla' => 'SA']);
        $society = Society::create(['nombre' => 'Sucursal de sociedad constituida en el extranjero','sigla' => 'SSCE']);
        $society = Society::create(['nombre' => 'Sociedad Anónima Mixta','sigla' => 'SAM']);
        $society = Society::create(['nombre' => 'Sociedad Colectiva','sigla' => 'SC']);
        $society = Society::create(['nombre' => 'Sociedad en Comandita Simple','sigla' => 'SCS']);
        $society = Society::create(['nombre' => 'Sociedad en Comandita por Acciones','sigla' => 'SCA']);        
    }
}
