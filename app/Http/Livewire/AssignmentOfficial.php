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

    public $ventana = 1;
    public $official_id;
    public $institution_id;
    public $oficial;

    public function mount()
    {
        $this->oficial = null;
    }

    public function render()
    {
        $assignments = Assignment::query();
        $assignments = $assignments->where('estado', 'ACTIVO');
        // if ($this->official_id != null) {
        //     $this->ventana = 2;
        //     $assignments = $assignments->where('official_id', $this->official_id);
        // }
        $assignments = $assignments->get();
        $officials = Official::all();
        $institutions = Institution::where('estado', "REGISTRADO")->get();
        return view('livewire.assignment-official', compact('officials', 'institutions', 'assignments'));
    }

    public function addAssignment()
    {
        $this->validate([
            'institution_id' => 'required',
        ]);

        $assignment = new Assignment();
        $assignment->official_id = $this->official_id;
        $assignment->institution_id = $this->institution_id;
        $assignment->user_id = auth()->user()->id;
        $assignment->save();

        $this->defaultAssignment();
    }

    public function setOficial($id)
    {
        $this->oficial = Official::find($id);
    }

    public function defaultAssignment()
    {
        $this->reset(['institution_id']);
        $this->ventana = 1;
    }

    public function softdeletedAssignment($id)
    {
        $assignment = Assignment::find($id);
        $assignment->estado = 'INACTIVO';
        $assignment->save();
    }
}
