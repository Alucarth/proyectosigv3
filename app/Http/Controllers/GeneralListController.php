<?php

namespace App\Http\Controllers;

use App\Models\GeneralList;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class GeneralListController extends Controller
{
    public function index()
    {

        return view('pages.generalList');
    }

    public function generalList($vacancy_id)
    {
        $vacancy = Vacancy::find($vacancy_id);
        // return $vacancy;
        if($vacancy)
        {
            return view('pages.generalListVacancy',compact('vacancy_id'));
        }
        return redirect('/');

    }
}
