<?php

namespace App\Http\Livewire;

use App\Models\Contract;
use App\Models\Package;
use App\Models\Payroll;
use App\Models\Person;
use App\Models\Vacancy;
use App\Models\GeneralList;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContractInstitution extends Component
{
    use WithFileUploads;

    public $ventana = 1;
    public $vacancia_id;
    public $person_id;
    public $payrolls;
    public $payroll_id;
    public $archivoContrato;
    public $codigo;
    public $package_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $contratos;

    //Extras

    public $dialog;
    public $dialogArchivo;
    public $urlfile;

    public function render()
    {
        if ($this->vacancia_id != null) {
            $this->ventana = 2;
            //$this->payrolls = Payroll::where('vacancy_id', $this->vacancia_id)->where('estado', "ACTIVO")->get();
            $this->payrolls = GeneralList::where('vacancy_id', $this->vacancia_id)->where('is_selected', true)->get();
            $this->contratos = Contract::where('vacancy_id', $this->vacancia_id)->get();
        }
        // $vacancies = Vacancy::where('estado', "ACTIVO")->where('cantidad', '>', 0)->get();
        $vacancies = Vacancy::get();
        $packages = Package::all();
        return view('livewire.contract-institution', compact('vacancies', 'packages'));
    }

    public function addContract()
    {
        $this->validate([
            'payroll_id' => 'required',
            'package_id' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'archivoContrato' => 'required|mimes:jpg,bmp,png,pdf|max:5120',
            'codigo' => 'required'
        ]);

        $this->ventana = 1;
        // $this->vacancia_id = null;

        // $payroll = Payroll::find($this->payroll_id);
        // $payroll->estado = "SELECCIONADO";
        // $payroll->save();

        $vacancy = Vacancy::find($this->vacancia_id);
        $contratoTotal = Contract::where('vacancy_id', $this->vacancia_id)->count();


         //dd($vacancy->cantidad,$contratoTotal );
        if($contratoTotal < $vacancy->cantidad){
            $payroll = new Payroll;
            $payroll->vacancy_id = $this->vacancia_id;
            $payroll->person_id = $this->payroll_id;
            $payroll->estado = "SELECCIONADO";
            $payroll->save();
            
            $contract = new Contract();
            $contract->institution_id = $payroll->vacancy->institution->id;
            $contract->vacancy_id = $payroll->vacancy->id;
            $contract->person_id = $payroll->person->id;
            $contract->package_id =  $this->package_id;
            $contract->fecha_inicio = $this->fecha_inicio;
            $contract->fecha_fin = $this->fecha_fin;
            $contract->archivo = str_replace("public/", "storage/", $this->archivoContrato->store('public'));
            $contract->codigo = $this->codigo;
            $contract->estado = "ACTIVO";
            $contract->save();

            $person = Person::find($payroll->person->id);
            $person->estado = "BENEFICIADO";
            $person->save();

            // $vacancy = Vacancy::find($payroll->vacancy->id);
            // $vacancy->cantidad = $vacancy->cantidad - 1;
            // if($vacancy->cantidad == 0){
            //     $vacancy->estado = "CONCLUIDO";
            // }
            // $vacancy->save();

            session()->flash('message', 'Los datos se guardaron correctamente.');

            foreach ($vacancy->payrolls as $payroll){
                $persona = Person::find($payroll->person->id);
                if($persona->estado == "SELECCIONADO") {
                    $persona->estado = "REGISTRADO";
                    $persona->save();
                }
            }
        }else{
            session()->flash('alert', 'Se alcanzo el cupo maximo.');
        }

        $this->clearContract();
    }


    public function deleteContrato($id)
    {
        $contrato = Contract::find($id);
        if($contrato)
        {
            $contrato->delete();
        }
        $this->contratos = Contract::where('vacancy_id', $this->vacancia_id)->get();
    }

    public function clearContract(){
        $this->reset(['payroll_id', 'package_id', 'archivoContrato', 'codigo']); 
    }

    public function closeModal()
    {
        $this->dialog=false;
        $this->dialogArchivo=false;
    }


    public function verArchivo($id)
    {
        $contrato = Contract::find($id);
        
        if($contrato)
        {
            
            $this->urlfile = $contrato->archivo;
            // $this->urlfile = $decendant->certificado;
            $this->dialogArchivo = true;
        }
        
    }
}
