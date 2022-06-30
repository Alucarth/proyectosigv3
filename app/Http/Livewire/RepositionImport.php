<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\RepositionImportExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Institution;
use App\Models\Person;
use App\Models\Contract;
use App\Models\Package;
use App\Models\Replacement;
use Carbon\Carbon;
use Log;
use Auth;

class RepositionImport extends Component
{
    use WithFileUploads;
    public $file_name;
    public $items;
    public $path;

    public function mount()
    {
        $this->file_name = '';
        $this->items=[];
        $this->path;
    }

    public function cargar()
    {
        $this->path =(string) $this->file_name->store("excels");
        Log::info(storage_path('app/').$this->path);
        $colections = Excel::toCollection(new RepositionImportExcel, storage_path("app//".$this->path));
        $this->items =[];
        foreach($colections[0] as $row)
        {
            $item =json_decode( json_encode($row));
            $item =(object) $item;
            array_push($this->items,$item);
        }

        unlink(storage_path('app/'.$this->path));
        Log::info(json_encode($this->items));
        Log::info('Se elimino el archivo temporal XD');

    }

    public function save()
    {
        foreach($this->items as $objeto)
        {
            $item = (object) $objeto;

            Log::info(json_encode($item));
            Log::info($item->beneficiario);
            $contrato =  Contract::where('codigo','=',$item->contrato)->first();
            if(!$contrato)
            {
                $institution = Institution::where('nit','=',$item->nit)->first();
                if(!$institution)
                {
                    $institution = new Institution;
                    $institution->razon_social = mb_strtoupper($item->empresa);
                    $institution->nit = $item->nit;
                    $institution->save();
                }

                $beneficiario = Person::where('ci','=',$item->ci)->first();
                if(!$beneficiario)
                {
                    $beneficiario = new Person;
                    $beneficiario->nombres=mb_strtoupper($item->beneficiario);
                    $beneficiario->ci = $item->ci;
                    $beneficiario->save();
                }

                $paquete = Package::where('nombre','=',mb_strtoupper($item->paquete))->first();
                if(!$paquete)
                {
                    $paquete = new Package;
                    $paquete->nombre = mb_strtoupper($item->paquete);
                    $paquete->save();
                }

                $contrato = new Contract;
                $contrato->institution_id = $institution->id;
                $contrato->person_id = $beneficiario->id;
                $contrato->package_id = $paquete->id;
                $contrato->codigo = mb_strtoupper($item->contrato);
                $contrato->cuenta = mb_strtoupper($item->cuenta);
                $contrato->fecha_inicio = Carbon::parse($item->fecha_inicio);
                $contrato->fecha_fin = Carbon::parse($item->fecha_fin);
                $contrato->monto_total = $item->monto;
                $contrato->salario_basico = $item->salario_basico;
                $contrato->save();



            }

            //generando repocicion recien XD

            $reposition = new Replacement;
            $reposition->contract_id = $contrato->id;
            $reposition->fecha_inicio = Carbon::parse($item->fecha_inicio_calculo);
            $reposition->fecha_fin = Carbon::parse($item->fecha_fin_calculo);
            $reposition->dias_cotizados = $item->dias_cotizados;
            $reposition->fecha_periodo = Carbon::parse($item->periodo);
            $reposition->nro_pago = $item->nro_pago;
            $reposition->monto = $item->monto;
            $reposition->descuentos_bonos = $item->descuento_bonificacion;
            $reposition->total_ganado = $item->liquido_pagable;
            $reposition->salario_basico = $item->primer_sb;
            $reposition->salario_basico2 = $item->segundo_sb;
            $reposition->monto_incentivo = $item->monto_incentivo;
            $reposition->official_id = Auth::user()->id;
            $reposition->save();

        }
        $this->file_name = '';
        $this->items=[];
        $this->path="";
    }

    public function render()
    {

        return view('livewire.reposition-import');
    }


}
