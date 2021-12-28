<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralList extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->belongsTo(Person::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }


}
