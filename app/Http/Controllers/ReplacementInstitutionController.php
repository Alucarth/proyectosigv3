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
        Log::info($ci);

        if(isset($ci) && $ci !==  '')
        {
            array_push($conditions,['ci','like',"%{$ci}%"]);
        }
        $repositions = DB::table('people_replacement')
                ->where($conditions)
                // ->where('ci','like',$this->ci)
                // ->orderBy('nro_pago')
                ->get();

        return response()->json(compact('repositions'));
    }
}
