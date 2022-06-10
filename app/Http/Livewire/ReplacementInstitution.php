<?php

namespace App\Http\Livewire;

use App\Models\Contract;
use App\Models\Petition;
use App\Models\Replacement;
use App\Models\Validation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ReplacementInstitution extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $ventana = 1;
    public $petition_id;
    public $petition;
    public $suma;
    public $replacement = [];
    public $ci;
    public $beneficiario;
    public $empresa;
    /*public $ventana = 1;
    public $contract_id;
    public $fechaInicio;
    public $fechaFin;
    public $monto;
    public $archivoC31;
    public $official_id;
    public $contractId;
    public $boleta;
    public $afp;
    public $cnb;

    public function mount()
    {
        $this->official_id = auth()->user()->official->id;
    }

    public function render()
    {
        if ($this->contract_id != null) {
            $this->ventana = 2;
        }
        if ($this->contractId != null) {
            $this->ventana = 3;
        }
        $contracts = Contract::where('estado', "ACTIVO")->get();
        return view('livewire.replacement-institution', compact('contracts'));
    }

    public function payContract()
    {
        $this->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'monto' => 'required|numeric',
            'archivoC31' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
        ]);

        $replacement = new Replacement();
        $replacement->contract_id = $this->contract_id;
        $replacement->fecha_inicio = $this->fechaInicio;
        $replacement->fecha_fin = $this->fechaFin;
        $replacement->monto = $this->monto;
        $replacement->c31 = $this->archivoC31->store('public');
        $replacement->official_id = $this->official_id;
        $replacement->save();

        $contract = Contract::find($this->contract_id);
        $contract->estado = "PAGADO";
        $contract->save();

        session()->flash('message', 'Los datos se guardaron correctamente.');

        $this->clearReplacement();
    }

    public function clearReplacement()
    {
        $this->ventana = 1;
        $this->reset(['contract_id', 'fechaInicio', 'fechaFin', 'monto', 'archivoC31']);
    }

    public function saveValidation()
    {
        $this->validate([
            'boleta' => 'required',
            'afp' => 'required',
            'cnb' => 'required'
        ]);

        if ($this->boleta == 0 || $this->afp == 0 || $this->cnb == 0) {
            session()->flash('alert', 'No cumple con la documentacion necesaria.');
        } else {
            $validation = new Validation();
            $validation->contract_id = $this->contractId;
            $validation->boleta = $this->boleta;
            $validation->afp = $this->afp;
            $validation->cnb = $this->cnb;
            $validation->estado = "VALIDADO";
            $validation->save();

            session()->flash('message', 'Los datos se guardaron correctamente.');
        }

        $this->clearValidationForm();
    }

    public function clearValidationForm()
    {
        $this->ventana = 1;
        $this->reset(['contractId', 'boleta', 'afp', 'cnb']);
    }*/

    public function render()
    {
        // if ($this->petition_id != null) {
        //     $this->ventana = 2;
        //     $this->petition = Petition::find($this->petition_id);
        //     foreach ($this->petition->forms as $form) {
        //         if ($form->contract->vacancy->salario > 4000) {
        //             $this->suma = $this->suma + round((4000 / 30) * $form->dias * ($form->contract->package->porcentaje / 100), 2);
        //         } else {
        //             $this->suma = $this->suma + round(($form->contract->vacancy->salario / 30) * $form->dias * ($form->contract->package->porcentaje / 100), 2);
        //         }
        //     }
        // }
        // $petitions = Petition::where('estado', 'ENVIADO')->paginate(10);

        return view('livewire.replacement-institution');
    }


    public function mount()
    {
        $this->replacement = [];
        $this->ci = '';
        $this->beneficiario = '';
        $this->empresa ='';


    }

    public function buscar()
    {
        $conditions = array();
        $ci = ''.$this->ci;
        if(isset($ci) && $ci !==  '')
        {
            array_push($conditions,['ci','like',"%{$ci}%"]);
        }

        $this->beneficiario = "buscando";
        // $this->replacement = DB::table('people_replacement')->get();
        $this->replacement = DB::table('people_replacement')
                            ->where($conditions)
                            // ->where('ci','like',$this->ci)
                            // ->orderBy('nro_pago')
                            ->get();

    }
}
