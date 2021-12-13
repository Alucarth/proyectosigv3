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
}
