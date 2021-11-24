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
        $society = Society::create(['nombre' => 'COMERCIANTE INDIVIDUAL O EMPRESA UNIPERSONAL','sigla' => 'EU']);
        $society = Society::create(['nombre' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA','sigla' => 'SRL']);
        $society = Society::create(['nombre' => 'SOCIEDAD ANÓNIMA','sigla' => 'SA']);
        $society = Society::create(['nombre' => 'SUCURSAL DE SOCIEDAD CONSTITUIDA EN EL EXTRANJERO','sigla' => 'SSCE']);
        $society = Society::create(['nombre' => 'SOCIEDAD ANÓNIMA MIXTA','sigla' => 'SAM']);
        $society = Society::create(['nombre' => 'SOCIEDAD COLECTIVA','sigla' => 'SC']);
        $society = Society::create(['nombre' => 'SOCIEDAD EN COMANDITA SIMPLE','sigla' => 'SCS']);
        $society = Society::create(['nombre' => 'SOCIEDAD EN COMANDITA POR ACCIONES','sigla' => 'SCA']);        
    }
}
