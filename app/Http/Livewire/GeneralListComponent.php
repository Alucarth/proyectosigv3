<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vacancy;
use App\Models\GeneralList;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
class GeneralListComponent extends Component
{
    public $vacancy;
    public $vacancy_id;
    public $general_list;
    public $short_list;
    public $persons;
    public $dialog_delete;

    public function mount()
    {
        $this->vacancy = Vacancy::find($this->vacancy_id);
        $this->refreshList();
        // $this->general_list = GeneralList::where('vacancy_id',$this->vacancy_id)->where('is_selected',false)->get();
        // $this->short_list = GeneralList::where('vacancy_id',$this->vacancy_id)->where('is_selected',true)->get();
        $this->persons = [];
        $this->dialog_delete = false;
    }

    public function generateList()
    {
        // $vacancy_id = $this->
        $this->persons = DB::table('people_careers')
                            ->where('career_id','=',$this->vacancy->career_id)
                            ->where('grado_academico',$this->vacancy->grado_academico)
                            ->get();

        foreach($this->persons as $person)
        {
            $item = new GeneralList;
            $item->people_id = $person->people_id;
            $item->institution_id = $this->vacancy->institution_id;
            $item->vacancy_id = $this->vacancy->id;
            $item->save();
        }
        $this->refreshList();
        // $this->general_list = GeneralList::where('vacancy_id',$this->vacancy_id)->get();

    }
    public function refreshList()
    {
        $this->general_list = GeneralList::where('vacancy_id',$this->vacancy_id)->where('is_selected',false)->get();
        $this->short_list = GeneralList::where('vacancy_id',$this->vacancy_id)->where('is_selected',true)->get();
    }
    public function addList($id)
    {
        $general_list = GeneralList::find($id);
        if($general_list)
        {
            $general_list->is_selected = true;
            $general_list->save();
        }
        $this->refreshList();

    }

    public function removeList($id)
    {
        $general_list = GeneralList::find($id);
        if($general_list)
        {
            $general_list->is_selected = false;
            $general_list->save();
        }
        $this->refreshList();
    }

    public function showDelete()
    {
        $this->dialog_delete = true;
    }
    public function closeDelete()
    {
        $this->dialog_delete = false;
    }

    public function render()
    {
        return view('livewire.general-list');
    }
}
