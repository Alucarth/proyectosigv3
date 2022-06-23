<?php

namespace App\Http\Controllers;

use App\Mail\Confirmation;
use App\Models\User;
use App\Models\Person;
use App\Models\Decendant;
use App\Models\PersonProblem;
use App\Models\Contact;
use App\Models\CareerPerson;
use App\Models\Experience;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Util;
use PDF;

class RegisterPersonController extends Controller
{
    public function person()
    {
        $person = Person::where('user_id', auth()->user()->id)->first();
        return view('pages.dataPerson', compact("person"));
    }

    public function dashboard()
    {
        $person = Person::where('user_id', auth()->user()->id)->first();
        return view('pages.dashboard', compact("person"));
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


        return redirect()->intended('/')->with("alert", "Mediante Instructivo MPD/UGCPNE-IN 0002/2020 se suspende el registro debido a que el programa se encuentra en etapa de cierre. Gracias por su comprension");

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

    public function pdfRegistroPerson()
    {
        set_time_limit(0);

        $person = Person::where('user_id', auth()->user()->id)->first();
        $decendants = Decendant::where('person_id', $person->id)->get();
        $personProblem = PersonProblem::where('person_id', $person->id)->get();
        $contacts = Contact::where('person_id', $person->id)->where('institution', null)->get();
        $studies = CareerPerson::where('person_id', $person->id)->get();
        $experiences = Experience::where('person_id', $person->id)->get();
        $contactsLaboral = Contact::where('person_id', $person->id)->where('institution', '!=', null)->get();
        // $branchs = Branch::where('institution_id', $institution->id)->get();
        // $cordinators = Coordinator::where('institution_id', $institution->id)->get();



        $data = [
            'title' => 'FICHA DE SOLICITANTE',
            'date' => date('m/d/Y'),
            'person' => $person,
            'decendants'=> $decendants,
            'personProblem'=>$personProblem,
            'contacts' => $contacts,
            'studies' => $studies,
            'experiences' => $experiences,
            'contactsLaboral'=>$contactsLaboral
            // 'branchs'=> $branchs,
            // 'cordinators'=> $cordinators,
        ];

        $pdf = PDF::loadView('reports.pdfRegistroPersona', $data);

        //return $pdf->download('DATOS-EMPRESA.pdf');
        return $pdf->stream('DATOS-PERSONA.pdf');
    }
}
