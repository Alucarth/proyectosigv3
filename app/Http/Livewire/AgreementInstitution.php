<?php

namespace App\Http\Livewire;

use App\Models\Agreement;
use App\Models\Assignment;
use App\Models\Institution;
use App\Models\Official;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AgreementInstitution extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $listeners = ['eliminarConvenio'];

    public $fechaConvenio;
    public $finConvenio;
    public $archivoConvenio;
    public $usuario;
    public $official_id;
    public $institution_id;
    public $detalle;
    public $assignments;
    public $tipoConsulta;

    //Extras

    public $dialog;
    public $dialogArchivo;
    public $urlfile;

    public function mount()
    {
        $this->usuario = auth()->user()->id;
        $this->official_id = Official::where('user_id',auth()->user()->id)->first()->id;
        $this->assignments = [];
        $this->tipoConsulta = 'CONVENIOS';
        $this->dialog =false;
        $this->dialogArchivo =false;
    }

    public function render()
    {
        // $this->assignments = Assignment::where('official_id', $this->official_id)->where('estado', "ACTIVO")->get();
        // if($this->institution_id != null) {
        //     $this->ventana = 2;
        // }

        if ($this->tipoConsulta == "CONVENIOS") {
            $this->assignments = Institution::join('assignments', 'institutions.id', '=', 'assignments.institution_id')
            ->leftJoin('agreements', 'institutions.id', '=', 'agreements.institution_id')
            ->where('assignments.official_id', $this->official_id)            
            ->where('assignments.estado', "ACTIVO")
            ->get(['institutions.id as institution_id', 
            'institutions.razon_social', 
            'institutions.nit',
            'institutions.estado as institution_estado',
            'assignments.estado as assignment_estao',
            'agreements.fecha_convenio',
            'agreements.fin_convenio',
            'agreements.convenio',
            'agreements.detalle',
            ]);
        }

        if ($this->tipoConsulta == "PENDIENTES") {

            // $this->assignments = Assignment::join('institutions', 'institutions.id', '=', 'assignments.institution_id')
            // ->where('official_id', $this->official_id)
            // ->where('institutions.estado', "REGISTRADO")
            // ->where('assignments.estado', "ACTIVO")
            // ->get(['assignments.*', 'institutions.nit','institutions.razon_social','institutions.estado as estado_institution']);

            $this->assignments = Institution::join('assignments', 'institutions.id', '=', 'assignments.institution_id')
            ->leftJoin('agreements', 'institutions.id', '=', 'agreements.institution_id')
            ->where('assignments.official_id', $this->official_id)            
            ->where('assignments.estado', "ACTIVO")
            ->where('institutions.estado', "REGISTRADO")
            ->get(['institutions.id as institution_id', 
            'institutions.razon_social', 
            'institutions.nit',
            'institutions.estado as institution_estado',
            'assignments.estado as assignment_estao',
            'agreements.fecha_convenio',
            'agreements.fin_convenio',
            'agreements.convenio',
            'agreements.detalle',
            ]);
        } 

        if ($this->tipoConsulta == "FIRMADOS") {
            
            // $this->assignments = Assignment::join('institutions', 'institutions.id', '=', 'assignments.institution_id')
            // ->where('official_id', $this->official_id)
            // ->where('institutions.estado', "ACTIVO")
            // ->where('assignments.estado', "ACTIVO")
            // ->get(['assignments.*', 'institutions.nit','institutions.razon_social','institutions.estado as estado_institution']);
            $this->assignments = Institution::join('assignments', 'institutions.id', '=', 'assignments.institution_id')
            ->leftJoin('agreements', 'institutions.id', '=', 'agreements.institution_id')
            ->where('assignments.official_id', $this->official_id)            
            ->where('assignments.estado', "ACTIVO")
            ->where('institutions.estado', "ACTIVO")
            ->get(['institutions.id as institution_id', 
            'institutions.razon_social', 
            'institutions.nit',
            'institutions.estado as institution_estado',
            'assignments.estado as assignment_estao',
            'agreements.fecha_convenio',
            'agreements.fin_convenio',
            'agreements.convenio',
            'agreements.detalle',
            ]);
        }         

        return view('livewire.agreement-institution', compact($this->assignments));
    }


    public function getListaConvenios($tipo)
    {   
        $this->tipoConsulta = $tipo;
    }

    public function createAgreement()
    {
        $this->validate([
            'fechaConvenio' => 'required|date',
            'finConvenio' => 'required|date|after_or_equal:fechaConvenio',
            'detalle' => 'required',
            'archivoConvenio' => 'required|mimes:pdf|max:5120'
        ],[
            'fechaConvenio.required' => 'El campo Fecha inicio es obligatorio!',
            'finConvenio.required' => 'El campo Fecha fin Principal es obligatorio!',
            'archivoConvenio.required' => 'El archivo digital de convenio es obligatorio!',
            'finConvenio.after_or_equal' => 'La Fecha fin debe ser igual o mayor a la fecha inicial.',            
        ]
        );

        $agreement = new Agreement();
        $agreement->institution_id = $this->institution_id;
        $agreement->fecha_convenio = $this->fechaConvenio;        
        $agreement->fin_convenio = $this->finConvenio;      
        $agreement->detalle = $this->detalle;
        $agreement->convenio = str_replace("public/", "storage/", $this->archivoConvenio->store('public'));
        $agreement->user_id = $this->usuario;
        $agreement->save();

        $institution = Institution::find($this->institution_id);
        $institution->estado = "ACTIVO";
        $institution->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->defaultAgreement();

        $this->closeModal();

    }

    public function defaultAgreement()
    {
        $this->reset(['institution_id', 'fechaConvenio', 'archivoConvenio']);
    }

    public function showModal($id)
    {
        $this->institution_id = $id; 
        $this->dialog =true;  

    }

    public function closeModal()
    {
        $this->dialog=false;
        $this->dialogArchivo=false;
    }


    public function verArchivo($id)
    {
        $convenio = Agreement::where('institution_id',$id)->where('estado', 'ACTIVO')->get();
        
        if($convenio)
        {
            
            $this->urlfile = $convenio[0]['convenio'];
            // $this->urlfile = $decendant->certificado;
            $this->dialogArchivo =true;
        }
        
    }


    public function alertEliminarConvenio($id)
    {
       $this->institution_id = $id; 
       $this->dispatchBrowserEvent('swal:confirmEliminarConvenio', [
            'type' => 'warning',  
            'message' => 'Eliminar Convenio?', 
            'text' => ''
        ]);
        
    }

    public function eliminarConvenio()
    {
        $convenio = Agreement::where('institution_id',$this->institution_id);       
        
        if($convenio){
            $convenio->delete();
            $institution = Institution::find($this->institution_id);
            $institution->estado = 'REGISTRADO';
            $institution->save();
            // session()->flash('message', 'Se elimino el registro correctamente.');
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Se Eliminó el convenio.']);
        }
    }



    /*public function downloadAgreement($id)
    {
        $agreement = Agreement::find($id);
        return Storage::download($agreement->convenio);
    }

    public function softDeleteAgreement($id)
    {
        $agreement = Agreement::find($id);
        $agreement->estado = "INACTIVO";
        $agreement->save();

        $institution = Institution::find($agreement->institution->id);
        $institution->estado = "REGISTRADO";
        $institution->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');
    }

    public function defaultFilters()
    {
        $this->reset(['searchInstitution', 'searchDate', 'searchState']);
    }*/
}
