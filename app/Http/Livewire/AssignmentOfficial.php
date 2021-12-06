<?php

namespace App\Http\Livewire;

use App\Models\Assignment;
use App\Models\Institution;
use App\Models\Official;
use Livewire\Component;
use Livewire\WithPagination;

class AssignmentOfficial extends Component
{
    use WithPagination;

    // public $ventana = 1;
    // public $official_id;
    public $institution_id;
    public $oficial;
    public $dialog_asignacion;
    public $assignments;
    public $institutions;

    public function mount()
    {
        $this->oficial = null;
        $this->dialog_asignacion = false;
        $this->assignments = [];
        $this->institutions = [];
    }

    public function render()
    {
        // $assignments = Assignment::query();
        // $assignments = $assignments->where('estado', 'ACTIVO');
        // if ($this->official_id != null) {
        //     $this->ventana = 2;
        //     $assignments = $assignments->where('official_id', $this->official_id);
        // }
        // $assignments = $assignments->get();
        $officials = Official::all();
        // $institutions = Institution::where('estado', "REGISTRADO")->get();
        return view('livewire.assignment-official', compact('officials'));
    }

    public function addAssignment()
    {
        $this->dialog_asignacion = false;
        $this->validate([
            'institution_id' => 'required',
        ]);

        $assignment = new Assignment();
        $assignment->official_id = $this->oficial->id;
        $assignment->institution_id = $this->institution_id;
        $assignment->user_id = auth()->user()->id;
        $assignment->save();

        $this->actualizarInformacion();
        // $this->defaultAssignment();
    }

    public function setOficial($id)
    {
        $this->oficial = Official::find($id);
     
        $this->actualizarInformacion();
    }

    // public function defaultAssignment()
    // {
    //     $this->reset(['institution_id']);
    //     $this->ventana = 1;
    // }
    public function actualizarInformacion()
    {
        if($this->oficial)
        {
            $this->assignments  = Assignment::where('estado','ACTIVO')
            ->where('official_id',$this->oficial->id)
            ->get();
            $ids_ban = Assignment::where('estado','ACTIVO')->pluck('institution_id');
            $this->institutions = Institution::where('estado','REGISTRADO')->whereNotIn('id',$ids_ban)->get();
        }
    }

    public function softdeletedAssignment($id)
    {
        $assignment = Assignment::find($id);
        if($assignment)
        {
            $assignment->estado = 'INACTIVO';
            $assignment->save();

            $this->actualizarInformacion();
        }
    }

    public function showAsignacion()
    {
        $this->dialog_asignacion = true;
    }

    public function closeAsignacion()
    {
        $this->dialog_asignacion = false;
    }
}
