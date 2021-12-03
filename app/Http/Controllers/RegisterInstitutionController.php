<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Society;
use App\Models\Institution;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Util;
// use Log;

class RegisterInstitutionController extends Controller
{
    public function institution()
    {
        //$institution = Institution::find(auth()->user()->institution_id);
        $institution = Institution::where('user_id', auth()->user()->id)->first();
        return view('pages.dataInstitution', compact("institution"));
    }

    public function editEstadoIntitution()
    {
        //$institution = Institution::find(auth()->user()->institution_id);
        $institution = Institution::where('user_id', auth()->user()->id)->first();
        $institution->estado = "PENDIENTE";
        $institution->save();
        return view('pages.dataInstitution', compact("institution"));
    }

    public function activeVacanciasIntitution()
    {
        //$institution = Institution::find(auth()->user()->institution_id);
        $institution = Institution::where('user_id', auth()->user()->id)->first();
        $institution->estado = "ACTIVO";
        $institution->save();
        return redirect()->route('vacancy.institution');
    }


    public function register()
    {
        $societies = Society::all();
        return view('pages.registerInstitution', compact('societies'));
    }

    public function dashboard()
    {
        $institution = Institution::where('user_id', auth()->user()->id)->first();
        return view('pages.institutionDashboard', compact("institution"));
    }

    public function store(Request $request)
    {
        $rules = [
            'razonSocial' => 'required',
             // 'nombreComercial' => 'required',
            'society' => 'required',
            'nit' => 'required|numeric|unique:institutions',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ];

        $messages = [
            'razonSocial.required' => 'El campo Razon Social es obligatorio!',
            // 'nombreComercial.required' => 'El campo Nombre Compercial es obligatorio!',
            'society.required' => 'El campo Tipo de Sociedad es obligatorio!',
            'nit.required' => 'El campo NIT es obligatorio!',
            'nit.numeric' => 'El campo NIT debe ser numérico!',
            'email.required' => 'El campo Email es obligatorio!',            
            'email.email' => 'Email no valido!',
            'password.required' => 'El campo Contraseña es obligatorio!',
            'captcha.required' => 'El campo Captcha es obligatorio!',            
            'captcha.captcha' => 'Captcha no valido!',
        ];

        $request->validate($rules, $messages);
        // Log::info($request->all());
        DB::beginTransaction();

        try {
            

            $user = new User();            
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->codigo = Str::uuid()->toString();
            $user->activation = 1;
            $user->save();

            $user->assignRole('empresa');


            $institution = new Institution();
            $institution->user_id = $user->id;
            $institution->razon_social = $request->razonSocial;
            // $institution->nombre_comercial = $request->nombreComercial;
            $institution->society_id = $request->society;
            $institution->nit = $request->nit;
            $institution->save();

            //Enviando Correo de Bienvenida
            Util::SendMailWelcome($user->email);


        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->intended('/registro-empresa')->with("alert", "Se produjo un error, vuelve a intentarlo");
        }

        DB::commit();

        return redirect()->intended('/')->with("message", "Registrado correctamente, Ahora puede iniciar Sesión.");
    }
}
