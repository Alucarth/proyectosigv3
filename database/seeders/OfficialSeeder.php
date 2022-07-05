<?php

namespace Database\Seeders;

use App\Models\Official;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->email = "admin@sigv3.com";
        $user->codigo = Str::uuid()->toString();
        $user->activation = 1;
        $user->password = bcrypt("515t3m45");
        $user->save();

        $user->assignRole('admin');

        $official = new Official();
        $official->nombres = "ADMIN";
        $official->paterno = "ADMIN";
        $official->materno = "ADMIN";
        $official->user_id = $user->id;
        $official->save();



        $user = new User();
        $user->email = "oficial@sigv3.com";
        $user->codigo = Str::uuid()->toString();
        $user->activation = 1;
        $user->password = bcrypt("0f1c14l");
        $user->save();

        $user->assignRole('oficial');

        $official = new Official();
        $official->nombres = "OFICIAL";
        $official->paterno = "OFICIAL";
        $official->materno = "OFICIAL";
        $official->user_id = $user->id;
        $official->save();


        $user = new User();
        $user->email = "blanca.aruquipa@planificacion.gob.bo";
        $user->codigo = Str::uuid()->toString();
        $user->activation = 1;
        $user->password = bcrypt("0f1c14l");
        $user->save();

        $user->assignRole('oficial');

        $official = new Official();
        $official->nombres = "BLANCA HELEN";
        $official->paterno = "ARUQUIPA";
        $official->materno = "MAYTA";
        $official->user_id = $user->id;
        $official->save();

        $user = new User();
        $user->email = "denny.munoz@planificacion.gob.bo";
        $user->codigo = Str::uuid()->toString();
        $user->activation = 1;
        $user->password = bcrypt("0f1c14l");
        $user->save();

        $user->assignRole('oficial');

        $official = new Official();
        $official->nombres = "DENNY JUCELIA";
        $official->paterno = "MUÑOZ";
        $official->materno = "ANTEQUERA";
        $official->user_id = $user->id;
        $official->save();

        $user = new User();
        $user->email = "milenka.acarapi@planificacion.gob.bo";
        $user->codigo = Str::uuid()->toString();
        $user->activation = 1;
        $user->password = bcrypt("0f1c14l");
        $user->save();

        $user->assignRole('oficial');

        $official = new Official();
        $official->nombres = "MILENKA GLADYZ";
        $official->paterno = "ACARAPI";
        $official->materno = "PEREZ";
        $official->user_id = $user->id;
        $official->save();


        $user = new User();
        $user->email = "lency.chura@planificacion.gob.bo";
        $user->codigo = Str::uuid()->toString();
        $user->activation = 1;
        $user->password = bcrypt("0f1c14l");
        $user->save();

        $user->assignRole('oficial');

        $official = new Official();
        $official->nombres = "LENCY CRISTHIAN";
        $official->paterno = "CHURA";
        $official->materno = "CALLISAYA";
        $official->user_id = $user->id;
        $official->save();




        $user = new User();
        $user->email = "responsable@sigv3.com";
        $user->codigo = Str::uuid()->toString();
        $user->activation = 1;
        $user->password = bcrypt("r35p054bl3");
        $user->save();

        $user->assignRole('responsable');

        $official = new Official();
        $official->nombres = "RESPONSABLE";
        $official->paterno = "RESPONSABLE";
        $official->materno = "RESPONSABLE";
        $official->user_id = $user->id;
        $official->save();




        $user = new User();
        $user->email = "fiduciario@sigv3.com";
        $user->codigo = Str::uuid()->toString();
        $user->activation = 1;
        $user->password = bcrypt("f1duc14r10");
        $user->save();

        $user->assignRole('fiduciario');

        $official = new Official();
        $official->nombres = "FIDUCIARIO";
        $official->paterno = "FIDUCIARIO";
        $official->materno = "FIDUCIARIO";
        $official->user_id = $user->id;
        $official->save();

    }
}
