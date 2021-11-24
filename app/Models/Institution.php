<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function branchs()
    {
        return $this->hasMany(Branch::class);
    }

    public function coordinators()
    {
        return $this->hasMany(Coordinator::class);
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function agreements()
    {
        return $this->hasMany(Agreement::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function petitions()
    {
        return $this->hasMany(Petition::class);
    }
}
