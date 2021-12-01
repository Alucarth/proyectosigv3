<?php

namespace App\Http\Livewire;

use App\Models\Career;
use App\Models\CareerPerson;
use App\Models\Contact;
use App\Models\Decendant;
use App\Models\Department;
use App\Models\Experience;
use App\Models\Person;
use App\Models\PersonProblem;
use App\Models\Problem;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Util;
use Carbon\Carbon;
class WizzardPerson extends Component
{

    use WithFileUploads;
    use WithPagination;

    //variables iniciales
    public $person;
    public $person_id;
    public $step;

    //varaibales de persona
    public $ci;
    public $expedido;
    public $genero;
    public $edad;
    public $nacimiento;
    public $departamento;
    public $direccion;
    public $estadoCivil;
    public $hijos;
    public $discapacidad;
    public $tipoDiscapacidad;
    public $archivod;
    public $telefonoPersona;

    //variables hijos
    public $nombreHijo;
    public $nacimientoHijo;
    public $archivoHijo;

    //variables dificultad
    public $problema;
    public $detalle;

    //variables de contacto;
    public $nombreContacto;
    public $paternoContacto;
    public $maternoContacto;
    public $telefonoContacto;

    //variables de formacion profesional
    public $carrera;
    public $institutionFormacion;
    public $gradoFormacion;
    public $egresoFormacion;
    public $archivoFormacion;

    //variables de experiencia laboral
    public $institutionLaboral;
    public $cargoLaboral;
    public $fecha_inicio;
    public $fecha_fin;
    public $archivoLaboral;
    public $total_years;

    //variables de referencia laboral
    public $institutionReferencia;
    public $nombreReferencia;
    public $paternoReferencia;
    public $maternoReferencia;
    public $telefonoReferencia;
    //variables auxiliares
    public $urlfile;
    public $dialog;
    public $dialog_hijo;
    public $dialog_dificultad;
    public $dialog_contacto;

    public function render()
    {


        $departments = Department::all();
        $problems = Problem::all();
        $decendants = Decendant::where('person_id', $this->person_id)->get();
        $difficulties = PersonProblem::where('person_id', $this->person_id)->get();
        $personContacts = Contact::where('person_id', $this->person_id)->where('institution', null)->get();
        $careers = Career::all();
        $studies = CareerPerson::where('person_id', $this->person_id)->get();
        $experiences = Experience::where('person_id', $this->person_id)->get();
        $totalyears = 0;
        foreach ($experiences as $exp) {
            # code...
            $date1 = Carbon::createFromDate($exp->fecha_inicio);
            $date2 = Carbon::createFromDate($exp->fecha_fin);
            $totalyears +=  $date1->diffInYears($date2);
    
        }
        $contacts = Contact::where('person_id', $this->person_id)->where('institution', '!=', null)->get();
        return view('livewire.wizzard-person', compact('departments', 'problems', 'decendants', 'difficulties', 'personContacts', 'careers', 'studies', 'experiences', 'contacts', 'totalyears'));
    }

    //steps 
    public function step1()
    {
        $this->step = 1;
    }

    public function step2()
    {
        $this->step = 2;
    }

    public function step3()
    {
        $this->step = 3;
    }

    public function step4()
    {
        $this->step = 4;
    }

    public function step5()
    {
        $this->step = 5;
    }

    public function mount()
    {
        $this->ci = $this->person->ci;
        $this->expedido = $this->person->expedido;
        $this->genero = $this->person->genero;
        $this->edad = $this->person->edad;
        $this->nacimiento = $this->person->nacimiento;
        $this->departamento = $this->person->department_id;
        $this->direccion = $this->person->direccion;
        $this->estadoCivil = $this->person->estado_civil;
        $this->hijos = $this->person->hijos;
        $this->discapacidad = $this->person->discapacidad;
        $this->tipoDiscapacidad = $this->person->tipo_discapacidad;
        $this->telefonoPersona = $this->person->telefono;
        $this->urlfile='/';
        $this->dialog =false;
        $this->dialog_hijo = false;
        $this->dialog_dificultad = false;
        $this->dialog_contacto = false;
        $this->total_years = 0;
        //$this->archivod = $this->person->archivod;
    }
    
    public function updatedNacimiento()
    {
        $this->edad = Util::calculateYear($this->nacimiento);
    }

    public function deleteHijo($id)
    {
        $decendant = Decendant::find($id);
        if($decendant)
        {
            $decendant->delete();
        }
    }
    public function deleteDifficulty($id)
    {
        $difficulty = PersonProblem::find($id);
        if($difficulty)
        {
            $difficulty->delete();
        }
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
    }

    public function setArchivo($id)
    {
        $decendant = Decendant::find($id);
        if($decendant)
        {
            
            $this->urlfile = "/storage".substr($decendant->certificado, 6);
            // $this->urlfile = $decendant->certificado;
            $this->dialog =true;
        }
        
    }

    public function closeModal()
    {
        $this->dialog=false;
    }

    public function saveHijo()
    {
        $this->dialog_hijo = false;
        $this->validate([
            'nombreHijo' => 'required',
            'nacimientoHijo' => 'required|date',
            'archivoHijo' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
        ]);
        $decendant = new Decendant();
        $decendant->person_id = $this->person_id;
        $decendant->nombre = mb_strtoupper($this->nombreHijo);
        $decendant->nacimiento = $this->nacimientoHijo;
        $decendant->certificado = $this->archivoHijo->store('public');
        $decendant->save();



        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->defaultHijo();
    }

    public function showHijo()
    {
        $this->dialog_hijo = true;
    }
    public function closeHijo()
    {
        $this->dialog_hijo = false;
    }
    public function defaultHijo()
    {
        $this->nombreHijo = "";
        $this->nacimientoHijo = "";
        $this->archivoHijo = null;
    }

    public function saveDifficulty()
    {
        $this->dialog_dificultad=false;
        $this->validate([
            'problema' => 'required',
            'detalle' => 'required'
        ]);
        $difficulty = new PersonProblem();
        $difficulty->person_id = $this->person_id;
        $difficulty->problem_id = $this->problema;
        $difficulty->detalle = mb_strtoupper( $this->detalle);
        $difficulty->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->defaultDifficulty();
    }
    public function showDificultad()
    {
        $this->dialog_dificultad = true;
    }

    public function closeDificultad()
    {
        $this->dialog_dificultad = false;
    }

    public function defaultDifficulty()
    {
        $this->problema = "";
        $this->detalle = "";
    }

    public function updatePerson()
    {
        // $this->dispatchBrowserEvent('alerta');
        if ($this->discapacidad) {
            $person = Person::find($this->person_id);
            if($person->certificado_discapacidad != null){
                $this->validate([
                    'ci' => 'required',
                    'expedido' => 'required',
                    'genero' => 'required',
                    'edad' => 'required|numeric',
                    'nacimiento' => 'required|date',
                    'departamento' => 'required',
                    'direccion' => 'required',
                    'hijos' => 'required',
                    'estadoCivil' => 'required',
                    'telefonoPersona' => 'required|numeric',
                    'discapacidad' => 'required'
                ]);
            } else {
                $this->validate([
                    'ci' => 'required',
                    'expedido' => 'required',
                    'genero' => 'required',
                    'edad' => 'required|numeric',
                    'nacimiento' => 'required|date',
                    'departamento' => 'required',
                    'direccion' => 'required',
                    'hijos' => 'required',
                    'estadoCivil' => 'required',
                    'telefonoPersona' => 'required|numeric',
                    'tipoDiscapacidad' => 'required',
                    'archivod' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
                ]);
            } 
        } else {
            $this->validate([
                'ci' => 'required',
                'expedido' => 'required',
                'genero' => 'required',
                'edad' => 'required|numeric',
                'nacimiento' => 'required|date',
                'departamento' => 'required',
                'direccion' => 'required',
                'hijos' => 'required',
                'estadoCivil' => 'required',
                'telefonoPersona' => 'required|numeric',
                'discapacidad' => 'required'
            ]);
        }
        
        $this->validate([
            'ci' => 'required',
            'expedido' => 'required',
            'genero' => 'required',
            'edad' => 'required|numeric',
            'nacimiento' => 'required|date',
            'departamento' => 'required',
            'direccion' => 'required',
            'hijos' => 'required',
            'estadoCivil' => 'required',
            'telefonoPersona' => 'required|numeric'
        ]);

        $person = Person::find($this->person_id);
        $person->ci = $this->ci;
        $person->expedido = $this->expedido;
        $person->genero = $this->genero;
        $person->edad = $this->edad;
        $person->nacimiento = $this->nacimiento;
        $person->department_id = $this->departamento;
        $person->direccion = mb_strtoupper($this->direccion);
        $person->hijos = $this->hijos;
        $person->estado_civil = $this->estadoCivil;
        $person->telefono = $this->telefonoPersona;
        $person->step = 2;
        $person->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->step2();

        
        // $response = Http::post('https://sig.planificacion.gob.bo:8080/pge/v1/soapapiservicioexterno/consultadatopersonacertificacion', [
        //     'numeroDocumento' => $this->ci
        // ])->throw()->json();

        // if ($response["consultaDatoPersonaCertificacionResult"]["value"]["codigoRespuesta"] == 2) {
        //     $person = Person::find($this->person_id);
        //     $person->ci = $this->ci;
        //     $person->expedido = $this->expedido;
        //     $person->genero = $this->genero;
        //     $person->edad = $this->edad;
        //     $person->nacimiento = $this->nacimiento;
        //     $person->department_id = $this->departamento;
        //     $person->direccion = $this->direccion;
        //     $person->hijos = $this->hijos;
        //     $person->estado_civil = $this->estadoCivil;
        //     $person->telefono = $this->telefonoPersona;
        //     $person->step = 2;
        //     $person->validacion_segip = 1;
        //     $person->save();

        //     session()->flash('message', 'Los datos se guardaron correctamente.');

        //     $this->step2();
        // } else {
        //     $person = Person::find($this->person_id);
        //     $person->validacion_segip = 0;
        //     $person->save();
        //     session()->flash('alert', 'El carnet de identidad no es valido');
        // }
    }

    public function updateDiscapacidad()
    {
        if ($this->discapacidad) {
            $this->validate([
                'tipoDiscapacidad' => 'required',
                'archivod' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
            ]);
            $person = Person::find($this->person_id);
            $person->discapacidad = $this->discapacidad;
            $person->tipo_discapacidad = $this->tipoDiscapacidad;
            $person->certificado_discapacidad = $this->archivod->store('public');
            $person->save();
        } else {
            $this->validate([
                'discapacidad' => 'required',
            ]);
            $person = Person::find($this->person_id);
            $person->discapacidad = $this->discapacidad;
            $person->save();
        }

        session()->flash('message', 'Los datos se guardaron correctamente.');
    }

    public function contactoPersonal()
    {
        $this->dialog_contacto = false;
        $this->validate([
            'nombreContacto' => 'required',
            'paternoContacto' => 'required',
            'maternoContacto' => 'required',
            'telefonoContacto' => 'required|numeric'
        ]);

        $contador = Contact::where('person_id', $this->person_id)->where('estado', "ACTIVO")->whereNull('institution')->count();
        if ($contador >= 3) {
            session()->flash('alert', 'Solo puede tener 3 contactos registrados.');
        } else {
            $contact = new Contact();
            $contact->person_id = $this->person_id;
            $contact->nombre = mb_strtoupper($this->nombreContacto);
            $contact->paterno = mb_strtoupper($this->paternoContacto);
            $contact->materno = mb_strtoupper($this->maternoContacto);
            $contact->telefono = $this->telefonoContacto;
            $contact->save();

            session()->flash('message', 'Los datos se guardaron correctamente.');
        }

        $this->defaultContactoPersonal();
    }

    public function showContacto()
    {
        $this->dialog_contacto = true;
    }

    public function closeContacto()
    {
        $this->dialog_contacto = false;
    }


    public function deleteContacto($id)
    {
        $contacto = Contact::find($id);
        if($contacto)
        {
            $contacto->delete();
        }
    }

    public function defaultContactoPersonal()
    {
        $this->nombreContacto = "";
        $this->paternoContacto = "";
        $this->maternoContacto = "";
        $this->telefonoContacto = "";
    }

    public function updateStep3()
    {
        /*if ($this->discapacidad) {
            $this->validate([
                'tipoDiscapacidad' => 'required',
                'archivod' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
            ]);
        } else {
            $this->validate([
                'discapacidad' => 'required',
            ]);
        }

        $person = Person::find($this->person_id);
        $person->discapacidad = $this->discapacidad;
        $person->step = 3;
        $person->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');*/

        $person = Person::find($this->person_id);
        $person->step = 3;
        $person->save();

        $this->step3();
    }

    public function formacion()
    {
        $this->validate([
            'carrera' => 'required',
            'institutionFormacion' => 'required',
            'gradoFormacion' => 'required',
            'egresoFormacion' => 'required',
            'archivoFormacion' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
        ]);

        $study = new CareerPerson();
        $study->person_id = $this->person_id;
        $study->career_id = $this->carrera;
        $study->institution =mb_strtoupper( $this->institutionFormacion);
        $study->grado_academico = $this->gradoFormacion;
        $study->egreso = $this->egresoFormacion;
        $study->certificado = $this->archivoFormacion->store('public');
        $study->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->defaultFormacion();
    }

    public function deleteFormacion($id)
    {
        $career = CareerPerson::find($id);
        if($career)
        {
            $career->delete();
        }
    }

    public function setArchivoFormacion($id)
    {
        $career = CareerPerson::find($id);
        if($career)
        {
            
            $this->urlfile = "/storage".substr($career->certificado, 6);
            // $this->urlfile = $decendant->certificado;
            $this->dialog =true;
        }
        
    }

    public function defaultFormacion()
    {
        $this->career_id = "";
        $this->institutionFormacion = "";
        $this->gradoFormacion = "";
        $this->egresoFormacion = "";
        $this->archivoFormacion = "";
    }

    public function updateStep4()
    {
        $person = Person::find($this->person_id);
        $person->step = 4;
        $person->save();

        $this->step4();
    }

    public function experiencia()
    {
        $this->validate([
            'institutionLaboral' => 'required',
            'cargoLaboral' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'archivoLaboral' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
        ]);

        $experience = new Experience();
        $experience->person_id = $this->person_id;
        $experience->institution = mb_strtoupper( $this->institutionLaboral);
        $experience->cargo = mb_strtoupper( $this->cargoLaboral);
        $experience->fecha_inicio = $this->fecha_inicio;
        $experience->fecha_fin = $this->fecha_fin;
        $experience->certificado = $this->archivoLaboral->store('public');
        $experience->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->clearExperiencia();
    }

    public function deleteExperiencia($id)
    {
        $experiencia = Experience::find($id);
        if($experiencia)
        {
            $experiencia->delete();
        }
    }

    public function setArchivoExperiencia($id)
    {
        $experiencia = Experience::find($id);
        if($experiencia)
        {
            
            $this->urlfile = "/storage".substr($experiencia->certificado, 6);
            // $this->urlfile = $decendant->certificado;
            $this->dialog =true;
        }
        
    }


    public function clearExperiencia()
    {
        $this->institutionLaboral = "";
        $this->cargoLaboral = "";
        $this->experienciaLaboral = "";
        $this->archivoLaboral = "";
    }

    public function updateStep5()
    {
        $person = Person::find($this->person_id);
        $person->step = 5;
        $person->save();

        $this->step5();
    }

    public function referencia()
    {
        $this->validate([
            'institutionReferencia' => 'required',
            'nombreReferencia' => 'required',
            'paternoReferencia' => 'required',
            'maternoReferencia' => 'required',
            'telefonoReferencia' => 'required|numeric'
        ]);

        $contact = new Contact();
        $contact->person_id = $this->person_id;
        $contact->institution = mb_strtoupper( $this->institutionReferencia);
        $contact->nombre = mb_strtoupper( $this->nombreReferencia);
        $contact->paterno = mb_strtoupper( $this->paternoReferencia);
        $contact->materno = mb_strtoupper( $this->maternoReferencia);
        $contact->telefono = $this->telefonoReferencia;
        $contact->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->clearReferencia();
    }

   
    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        if($contact)
        {
            $contact->delete();
        }
    }

    public function clearReferencia()
    {
        $this->institutionReferencia = "";
        $this->nombreReferencia = "";
        $this->paternoReferencia = "";
        $this->maternoReferencia = "";
        $this->telefonoReferencia = "";
    }
}
