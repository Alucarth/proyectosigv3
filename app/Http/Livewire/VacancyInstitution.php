<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Career;
use App\Models\Institution;
use App\Models\Vacancy;
use Livewire\Component;

class VacancyInstitution extends Component
{
    protected $listeners = ['inactiveVacancy']; 
    public $institution_id;
    public $sucursal;
    public $nombreVacacia;
    public $gradoAcademico;
    public $carrera;
    public $descripcion;
    public $salario;
    public $cantidad;

    public $vacancy_id;

    public $showDivVacancias  = false;
    public $estadoAction = false;

    public function mount()
    {        
        
    }
    
    public function render()
    {   
        $institution = Institution::find($this->institution_id);
        $branches = Branch::where('institution_id', $this->institution_id)->get();
        $careers = Career::all();
        $vacancies = Vacancy::where('institution_id', $this->institution_id)->where('estado','!=', 'INACTIVO' )->get();
        return view('livewire.vacancy-institution', compact('institution', 'branches', 'careers', 'vacancies'));
    }

    public function addVacancy()
    {
        $this->validate([
            'sucursal' => 'required',
            'nombreVacacia' => 'required',
            'gradoAcademico' => 'required',
            'carrera' => 'required',
            'descripcion' => 'required',
            'salario' => 'required|numeric|min:2500',
            'cantidad' => 'required|integer|max:100'
        ],
        [
            'sucursal.required' => 'El campo Casa matriz/Sucursal es obligatorio!',
            'nombreVacacia.required' => 'El campo Denominación del Cargo es obligatorio!',
            'gradoAcademico.required' => 'El campo Grado Académico es obligatorio!',            
            'carrera.required' => 'El campo Área de Formación es obligatorio!',
            'descripcion.required' => 'El campo Descripción del Trabajo es obligatorio!',
            'salario.required' => 'El campo Salario mensual es obligatorio!',
            'salario.min' => 'El valor de salario debe ser mayor a Bs.2500.',
            'cantidad.required' => 'El campo Cantidad de Personal es obligatorio!',
        ]    
        );

        $vacancy = new Vacancy();
        $vacancy->institution_id = $this->institution_id;
        $vacancy->branch_id = $this->sucursal;
        $vacancy->nombre = mb_strtoupper($this->nombreVacacia);
        $vacancy->grado_academico = $this->gradoAcademico;
        $vacancy->career_id = $this->carrera;
        $vacancy->descripcion = mb_strtoupper($this->descripcion);
        $vacancy->salario = $this->salario;
        $vacancy->cantidad = $this->cantidad;
        $vacancy->estado = "PENDIENTE";//OLD ACTIVO
        $vacancy->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->defaultVacancy();
    }

    public function defaultVacancy()
    {
        $this->sucursal = "";
        $this->nombreVacacia = "";
        $this->gradoAcademico = "";
        $this->carrera = "";
        $this->descripcion = "";
        $this->salario = "";
        $this->cantidad = "";
        $this->showDivVacancias = false;
    }

    public function alertInactiveVacancy($vacancy_id)
    {
        $this->vacancy_id = $vacancy_id;
        $this->dispatchBrowserEvent('swal:confirmInactiveVacancy', [
            'type' => 'warning',  
            'message' => 'Dar de baja la Vacancia?', 
            'text' => 'La Vancia se dara de baja de la lista.'
        ]);
    }


    public function inactiveVacancy()
    {
        $vacancy = Vacancy::find($this->vacancy_id);
        $vacancy->estado = "INACTIVO";
        $vacancy->save();

        //$this->render();

        // session()->flash('message', 'Se dio de baja correctamente.');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',  
            'message' => 'Se dio de Baja el registro correctamente.!'
        ]);
    }
}
