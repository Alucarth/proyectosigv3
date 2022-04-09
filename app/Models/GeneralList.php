<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralList extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function people()
    {
        return $this->belongsTo(Person::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }


}
