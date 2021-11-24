<?php

namespace App\Http\Controllers;

use App\Mail\Confirmation;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Util;

class RegisterPersonController extends Controller
{
    public function person()
    {
        $person = Person::where('user_id', auth()->user()->id)->first();
        return view('pages.dataPerson', compact("person"));
    }

    public function register()
    {
        return view('pages.registerPerson');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombres' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ];

        $request->validate($rules);

        DB::beginTransaction();

        try {
            

            $user = new User();
            // $user->person_id = $person->id;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->codigo = Str::uuid()->toString();
            $user->activation = 1;
            $user->save();

            $person = new Person();
            $person->nombres = $request->nombres;
            $person->paterno = $request->paterno;
            $person->materno = $request->materno;
            $person->user_id = $user->id;
            $person->save();

            Util::SendMailWelcome($user->email);
            //Mail::to($request->email)->send(new Confirmation($user));

            $user->assignRole('persona');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->intended('/')->with("alert", "Algo salio mal, intentalo nuevamente");
        }

        DB::commit();

        return redirect()->intended('/')->with("message", "Registrado correctamente");
    }
}
