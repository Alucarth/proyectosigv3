<?php

namespace App\Exports;

use App\Models\GeneralList;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class GeneralListExport implements FromView
{
    use Exportable;
    private $institution_id,$vacancy_id,$selected,$title;

    public function __construct(int $institution_id,int $vacancy_id, $selected,$title)
    {
        $this->institution_id = $institution_id;
        $this->vacancy_id = $vacancy_id;
        $this->selected = $selected;
        $this->title = $title;
    }

    public function view(): View
    {
        $general_list = GeneralList::where('institution_id','=',$this->institution_id)
                                    ->where('vacancy_id','=',$this->vacancy_id)
                                    ->where('is_selected','=', $this->selected)
                                    ->get();
        $title = $this->title;

        return view('exports.generaList',compact('general_list','title') );
    }
}
