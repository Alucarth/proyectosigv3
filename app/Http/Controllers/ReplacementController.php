<?php

namespace App\Http\Controllers;

use App\Models\Replacement;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Imports\RepositionImportExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Institution;
use App\Models\Person;
use App\Models\Contract;
use App\Models\Package;

use Carbon\Carbon;
use Log;
use Auth;



class ReplacementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function import()
    {
        return view('pages.repositionImport');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /** Load file excel to view  */

    public function loadExcel(Request $request)
    {

        $items =[];
        $has_error=false;
        if($request->file('fileExcel'))
        {
            $path = $request->file('fileExcel')->store('excels');
            // $this->path =(string) $this->file_name->store("excels");
            // Log::info(storage_path('app/').$path);
            $colections = Excel::toCollection(new RepositionImportExcel, storage_path("app//".$path));

            $indice = 1;
            foreach($colections[0] as $row)
            {
                $has_error=false;
                $item =json_decode( json_encode($row));
                $item =(object) $item;
                /* validando informacion */

                $item->indice = $indice;
                $indice++;

                if(!property_exists($item,'empresa') )
                {
                    $item->empresa = 'x';
                    $has_error = true;
                }else
                {
                    $item->empresa = mb_strtoupper($item->empresa, 'UTF-8');
                }

                if(!property_exists($item,'contrato') )
                {
                    $item->contrato = 'x';
                    $has_error = true;
                }else
                {
                    $item->contrato = mb_strtoupper($item->contrato, 'UTF-8');
                }

                if(!property_exists($item,'beneficiario') )
                {
                    $item->beneficiario = 'x';
                    $has_error = true;
                }else
                {
                    $item->beneficiario = mb_strtoupper($item->beneficiario, 'UTF-8');
                }


                if(!property_exists($item,'observacion') )
                {
                    $item->observacion = ' ';

                }else
                {
                    $item->observacion = mb_strtoupper($item->observacion, 'UTF-8');
                }


                if(!property_exists($item,'tipo_reposicion') )
                {
                    $item->tipo_reposicion = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'periodo') )
                {
                    $item->periodo = 'x';
                    $has_error = true;
                }else
                {
                    $item->periodo = self::convertDate($item->periodo);
                }

                if(!property_exists($item,'fecha_inicio') )
                {
                    $item->fecha_inicio = 'x';
                    $has_error = true;
                }else
                {
                    $item->fecha_inicio = self::convertDate($item->fecha_inicio);
                    // $UNIX_DATE = ($item->fecha_inicio - 25569) * 86400;
                    // $item->fecha_inicio  = gmdate("d-m-Y", $UNIX_DATE);
                }

                if(!property_exists($item,'fecha_fin') )
                {
                    $item->fecha_fin = 'x';
                    $has_error = true;
                }else
                {
                    $item->fecha_fin = self::convertDate($item->fecha_fin);
                }


                if(!property_exists($item,'fecha_inicio_calculo') )
                {
                    $item->fecha_inicio_calculo = 'x';
                    $has_error = true;
                }else
                {
                    $item->fecha_inicio_calculo = self::convertDate($item->fecha_inicio_calculo);
                }

                if(!property_exists($item,'fecha_fin_calculo') )
                {
                    $item->fecha_fin_calculo = 'x';
                    $has_error = true;
                }else
                {
                    $item->fecha_fin_calculo = self::convertDate($item->fecha_fin_calculo);
                }

                //valores numericos

                if(!property_exists($item,'nit') )
                {
                    $item->nit = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'ci') )
                {
                    $item->ci = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'monto') )
                {
                    $item->monto = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'salario_basico') )
                {
                    $item->salario_basico = 'x';
                    $has_error = true;
                }


                if(!property_exists($item,'paquete') )
                {
                    $item->paquete = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'nro_pago') )
                {
                    $item->nro_pago = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'dias_cotizados') )
                {
                    $item->dias_cotizados = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'descuento_bonificacion') )
                {
                    $item->descuento_bonificacion = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'liquido_pagable') )
                {
                    $item->liquido_pagable = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'primer_sb') )
                {
                    $item->primer_sb = 'x';
                    $has_error = true;
                }

                if(!property_exists($item,'segundo_sb') )
                {
                    $item->segundo_sb = 'x';
                    $has_error = true;
                }


                if(!property_exists($item,'monto_incentivo') )
                {
                    $item->monto_incentivo = 'x';
                    $has_error = true;
                }


                $item->has_error = $has_error;

                // Log::info(json_encode($item));
                array_push($items,$item);
            }

            unlink(storage_path('app/'.$path));
            // Log::info(json_encode($items));
            // Log::info('Se elimino el archivo temporal XD');
        }



        return response()->json(compact('items'));

    }

    public function convertDate($excel_date)
    {
        $UNIX_DATE = ($excel_date - 25569) * 86400;
        return gmdate("d-m-Y", $UNIX_DATE);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $items = json_decode($request->items);

        foreach($items as $objeto)
        {
            $item = (object) $objeto;

            // Log::info(json_encode($item));
            // Log::info($item->beneficiario);
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
            $reposition->tipo = $item->tipo_reposicion;
            $reposition->observacion = $item->observacion;

            $reposition->save();

        }

        $message = "Se Importo correctamente las reposiciones";
        return response()->json(compact('message'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Replacement  $replacement
     * @return \Illuminate\Http\Response
     */
    public function show(Replacement $replacement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Replacement  $replacement
     * @return \Illuminate\Http\Response
     */
    public function edit(Replacement $replacement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Replacement  $replacement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Replacement $replacement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Replacement  $replacement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Replacement $replacement)
    {
        //
    }
}
