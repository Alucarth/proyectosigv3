<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Institution;
use App\Models\Person;

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
        $user->codigo = '1111111';
        $user->password = bcrypt('123456');
        $user->activation = 1;
        $user->save();

        $institution = new Institution;
        $institution->razon_social = 'David Corp';
        $institution->nombre_comercial = 'David Corp';
        $institution->society_id = 1;
        $institution->nit = '6047054016';
        $institution->roe = true;
        $institution->rubro = 'David Corp';
        $institution->nit = '6047054016';
        $institution->actividad = 'Software';
        $institution->nombre = 'Leandro David';
        $institution->paterno = 'torrez';
        $institution->materno = 'salinas';
        $institution->user_id = $user->id;
        $institution->save();

        $user = new User;
        $user->email = 'keyrus.wow@gmail.com';
        $user->codigo = '1111112';
        $user->password = bcrypt('123456');
        $user->activation = 1;
        $user->save();

        $person = new Person;
        $person->nombres = 'Ashbringer';
        $person->paterno = 'torrez';
        $person->materno = 'chuquimia';
        $person->ci = '6047054';
        $person->user_id = $user->id;
        $person->save();



    }
}
