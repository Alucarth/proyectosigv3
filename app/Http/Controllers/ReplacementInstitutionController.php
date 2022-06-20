<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class ReplacementInstitutionController extends Controller
{
    public function index()
    {
        return view('pages.replacementList');
    }

    public function data()
    {
        $conditions = array();
        $ci = request('ci')??'';
        $nombres = request('nombres')??'';
        $razon_social = request('razon_social')??'';

        Log::info($ci);

        $has_search =false;

        if(isset($ci) && $ci !==  '')
        {
            array_push($conditions,['ci','like',"%{$ci}%"]);
            $has_search = true;
        }

        if(isset($nombres) && $nombres !== '')
        {
            $nombres =  mb_strtoupper($nombres, 'UTF-8');
            array_push($conditions,['nombres','like',"%{$nombres}%"]);
            $has_search = true;
        }

        if(isset($razon_social) && $razon_social !== '')
        {
            $razon_social =  mb_strtoupper($razon_social, 'UTF-8');
            array_push($conditions,['razon_social','like',"%{$razon_social}%"]);
            $has_search = true;
        }


        if($has_search)
        {
            $repositions = DB::table('people_replacement')
                    ->where($conditions)
                    // ->where('ci','like',$this->ci)
                    // ->orderBy('nro_pago')
                    ->get();
        }else{
            $repositions = [];
        }

        return response()->json(compact('repositions'));
    }
}
