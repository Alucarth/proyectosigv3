<?php

namespace App\Http\Livewire;

use App\Exports\PetitionExport;
use App\Models\Contract;
use App\Models\Form;
use App\Models\Petition;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

class PetitionInstitution extends Component
{
    use WithPagination;

    public $ventana = 1;
    public $institution_id;
    public $titulo;
    public $petition_id;
    public $contract_id;
    public $dias;
    public $descuentos;
    public $bonificaciones;
    public $forms;
    public $salario;

    public function mount()
    {
        $this->institution_id = auth()->user()->institution->id;
    }

    public function render()
    {
        if ($this->petition_id != null) {
            $this->ventana = 2;
            $this->forms = Form::where('petition_id', $this->petition_id)->get();
        }
        $petitions = Petition::where('institution_id', $this->institution_id)->where('estado', 'ACTIVO')->orderBy('id', 'DESC')->paginate(10);
        $contracts = Contract::where('institution_id', $this->institution_id)->where('estado', 'ACTIVO')->get();
        return view('livewire.petition-institution', compact('petitions', 'contracts'));
    }

    public function createdPetition()
    {
        $this->validate([
            'titulo' => 'required'
        ]);

        $petition = new Petition();
        $petition->institution_id = $this->institution_id;
        $petition->titulo = $this->titulo;
        $petition->save();

        $this->clearPetition();
    }

    public function clearPetition()
    {
        $this->reset(['titulo']);
    }

    public function softDeletePetition($id)
    {
        $petition = Petition::find($id);
        $petition->estado = "INACTIVO";
        $petition->save();

        if ($petition->forms != null) {
            foreach($petition->forms as $form)
            {
                $contract = Contract::find($form->contract_id)->first();
                $contract->estado = 'ACTIVO';
                $contract->save();
            }
        }
    }

    public function sendPetition($id)
    {
        $petition = Petition::find($id);
        $petition->estado = "ENVIADO";
        $petition->save();
    }

    public function addForm()
    {
        $this->validate([
            'contract_id' => 'required',
            'salario' => 'required',
            'dias' => 'required|integer',
            'descuentos' => 'required',
            'bonificaciones' => 'required',
        ]);

        $form = new Form();
        $form->petition_id = $this->petition_id;
        $form->contract_id = $this->contract_id;
        $form->salario = $this->salario;
        $form->dias = $this->dias;
        $form->descuentos = $this->descuentos;
        $form->bonificaciones = $this->bonificaciones;
        $form->save();

        $contract = Contract::find($this->contract_id);
        $contract->estado = "REPOSICION";
        $contract->save();

        $this->clearForm();
    }

    public function clearForm()
    {
        $this->reset(['contract_id', 'salario', 'dias', 'descuentos', 'bonificaciones']);
    }

    public function exportExcel()
    {
        $date = Carbon::now()->toDateTimeString();
        return Excel::download(new PetitionExport($this->forms), "reposicion$date.xlsx");
    }
}
