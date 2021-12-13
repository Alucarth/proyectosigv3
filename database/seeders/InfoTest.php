<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Institution;

class InfoTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuario para empresa

        $user = new User;
        $user->email = 'ltorrezs2008@gmail.com';
        $user->password = bcrypt('123456');
        $user->activation = 1;
        $user->save();

        $institution = new Institution;
        $institution->razon_social = 'David Corp';
        $institution->nombre_comercial = 'David Corp';
        $institution->society_id = 1;
        $institution->nit = '6047054016';
        $institution->roe = 'David Corp';
        $institution->rubro = 'David Corp';
        $institution->nit = '6047054016';
        $institution->actividad = 'Software';
        $institution->nombre = 'Leandro David';
        $institution->paterno = 'torrez';
        $institution->materno = 'salinas';
        $institution->user_id = $user->id;
        $institution->save();

    }
}
