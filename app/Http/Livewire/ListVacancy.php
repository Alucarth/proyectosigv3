<?php

namespace App\Http\Livewire;

use App\Models\Person;
use App\Models\Payroll;
use App\Models\Vacancy;
use Livewire\Component;
use Barryvdh\DomPDF\PDF;
use App\Models\CareerPerson;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ListVacancy extends Component
{
    use WithPagination;

    public $vacancies;
    public $vacancia_id;
    public $ventana = 1;
    public $vacancia;
    public $data;
    public $departamento;
    public $person_id;
    public $ver;
    public $listacorta;
    public $genero;
    public $hijo;
    public $estadoCivil;
    public $state;

    public function mount()
    {
        $this->state= false;
        $this->loadVacancies();
    }

    public function loadVacancies()
    {
        if($this->state)
        {
            $this->vacancies = Vacancy::where('estado','ACTIVO')->get();

        }else{

            $this->vacancies = Vacancy::all();
        }
    }

    public function setState($state)
    {
        $this->state = $state;

        $this->loadVacancies();
    }

    public function render()
    {
        $peopleQuery = Person::query();
        $people = Person::query();

        if ($this->vacancia_id != null) {
            $this->vacancia = Vacancy::find($this->vacancia_id);
            $this->ventana = 2;
            /*$this->people = Person::whereHas('careers', function ($query) {
            $query->where('career_id', $this->vacancia->career_id)->where('grado_academico', 'Profecional');
        })->get();*/
            if ($this->vacancia->grado_academico == 'Profesional') {
                $peopleQuery = $peopleQuery->whereHas('careers', function ($query) {
                    $query->where('career_id', $this->vacancia->career_id)->where('grado_academico', 'Licenciatura');
                })->where('department_id', $this->vacancia->branch->department_id)->where('estado', '!=', 'SELECCIONADO')->where('estado', '!=', 'BENEFICIADO');
            }
            if ($this->vacancia->grado_academico == 'Técnico') {
                $peopleQuery = $peopleQuery->whereHas('careers', function ($query) {
                    $query->where('career_id', $this->vacancia->career_id)->where('grado_academico', 'Técnico');
                })->where('department_id', $this->vacancia->branch->department_id)->where('estado', '!=', 'SELECCIONADO')->where('estado', '!=', 'BENEFICIADO');
            }
            if ($this->vacancia->grado_academico == 'Egresado') {
                $peopleQuery = $peopleQuery->whereHas('careers', function ($query) {
                    $query->where('career_id', $this->vacancia->career_id)->where('grado_academico', 'Egresado');
                })->where('department_id', $this->vacancia->branch->department_id)->where('estado', '!=', 'SELECCIONADO')->where('estado', '!=', 'BENEFICIADO');
            }
            if ($this->vacancia->grado_academico == 'Bachillerato') {
                $peopleQuery = $peopleQuery->whereHas('careers', function ($query) {
                    $query->where('career_id', $this->vacancia->career_id)->where('grado_academico', 'Bachillerato');
                })->where('department_id', $this->vacancia->branch->department_id)->where('estado', '!=', 'SELECCIONADO')->where('estado', '!=', 'BENEFICIADO');
            }
        }
        if ($this->genero) {
            $peopleQuery = $peopleQuery->where('genero', $this->genero);
        }
        if ($this->hijo) {
            $peopleQuery = $peopleQuery->where('hijos', $this->hijo);
        }
        if ($this->estadoCivil) {
            $peopleQuery = $peopleQuery->where('estado_civil', $this->estadoCivil);
        }
        $people = $peopleQuery->paginate(10);
        if ($this->ver != null) {
            $this->ventana = 3;
            $this->listacorta = Payroll::where('vacancy_id', $this->ver)->get();
        }
        return view('livewire.list-vacancy', compact('people'));
    }

    public function addPayroll($person_id)
    {

        $verificar = Payroll::where('vacancy_id', $this->vacancia->id)->where('estado', "ACTIVO")->count();
        if ($verificar < 3) {
            $payroll = new Payroll();
            $payroll->person_id = $person_id;
            $payroll->vacancy_id = $this->vacancia->id;
            $payroll->save();

            $person = Person::find($person_id);
            $person->estado = "SELECCIONADO";
            $person->save();
            session()->flash('message', 'Los datos se guardaron correctamente.');
        } else {
            session()->flash('alert', 'La lista ya tiene 3 personas asignadas.');
        }
    }

    public function removePayroll($payroll_id)
    {
        $payroll = Payroll::find($payroll_id);
        $payroll->estado = "INACTIVO";
        $payroll->save();
        $person = Person::find($payroll->person_id);
        $person->estado = "REGISTRADO";
        $person->save();
        session()->flash('alert', 'El usuario a sido retirado de la lista');
    }

    public function downloadFile($career_id, $person_id)
    {
        $career = CareerPerson::where('career_id', $career_id)->where('person_id', $person_id)->first();
        return Storage::download($career->certificado);
    }

    public function clearList()
    {
        $this->reset(['genero', 'estadoCivil', 'hijo']);
    }

    public function downloadPDF()
    {
        $today = Carbon::now()->format('d/m/Y');
        $view = view('exports.shortlist', compact('today'))->render();
        $pdf = PDF::loadView($view);

        return $pdf->download('listacorta.pdf');
    }
}
