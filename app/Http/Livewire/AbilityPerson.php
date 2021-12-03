<?php

namespace App\Http\Livewire;

use App\Models\Ability;
use App\Models\Person;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class AbilityPerson extends Component
{
    
    public $habilidad;
    public $person;
    public $person_id;

    public function mount()
    {
        $this->person = Person::where('user_id','=',Auth::user()->id)->first();
    
    }

    public function render()
    {
        // $abilities = [];
        $abilities = Ability::where('person_id', $this->person->id)->get();
        return view('livewire.ability-person', compact('abilities'));
    }

    public function addAbility()
    {
        $this->validate([
            'habilidad' => 'required|max:256'
        ]);

        $ability =  new Ability();
        $ability->person_id = $this->person->id;
        $ability->descripcion = $this->habilidad;
        $ability->estado = "ACTIVO";
        $ability->save();

        $this->clearAbility();
    }

    public function deleteHabilidad($id)
    {
        $ability = Ability::find($id);
        if($ability)
        {
            $ability->delete();
        }
    }

    public function clearAbility()
    {
        $this->reset(['habilidad']);           
    }
}
