<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vacancy;
use App\Models\GeneralList;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
class GeneralListComponent extends Component
{
    public $vacancy;
    public $vacancy_id;
    public $general_list;
    public $persons;

    public function mount()
    {
        $this->vacancy = Vacancy::find($this->vacancy_id);
        $this->general_list = GeneralList::where('vacancy_id',$this->vacancy_id)->get();
        $this->persons = [];
    }

    public function generateList()
    {
       $this->persons = Person::whereHas('careers',function ( Builder $query){
                            $query->where('career_id',$this->vacancy->caeer_id);
                            })
                    ->get();

    }

    public function render()
    {
        return view('livewire.general-list');
    }
}
