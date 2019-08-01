<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function classifications()
    {
        return $this->hasMany(Classification::class);
    }

    public function getResumenAttribute()
    {
        return (object)[
            'dia'         => $this->classifications->where('day', 1)->count(),
            'noche'       => $this->classifications->where('day', 0)->count(),
            'animales'    => $this->classifications->where('animal', 1)->count(),
            'sinanimales' => $this->classifications->where('animal', 0)->count(),
        ];

    }

    public function classifyDay()
    {
        return ($this->resumen->dia > $this->resumen->noche) ? 1 : 0;
    }

    public function classifyAnimal()
    {
        return ($this->resumen->animales > $this->resumen->sinanimales) ? 1 : 0;
    }

    public function isValidated()
    {
        return ($this->validated && isset($this->day) && isset($this->animal));
    }

}
