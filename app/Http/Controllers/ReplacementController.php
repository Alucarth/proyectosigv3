<?php

namespace App\Http\Controllers;

use App\Models\Replacement;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Imports\RepositionImportExcel;
use Maatwebsite\Excel\Facades\Excel;
use Log;


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

        if($request->file('fileExcel'))
        {
            $path = $request->file('fileExcel')->store('excels');
            // $this->path =(string) $this->file_name->store("excels");
            // Log::info(storage_path('app/').$path);
            $colections = Excel::toCollection(new RepositionImportExcel, storage_path("app//".$path));

            foreach($colections[0] as $row)
            {
                $item =json_decode( json_encode($row));
                $item =(object) $item;
                array_push($items,$item);
            }

            unlink(storage_path('app/'.$path));
            // Log::info(json_encode($items));
            // Log::info('Se elimino el archivo temporal XD');
        }



        return response()->json(compact('items'));

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
