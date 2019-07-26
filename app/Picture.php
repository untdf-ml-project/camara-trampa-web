<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function getResumenAttribute()
    {
        return (object)[
            'dia' => $this->categories->where('day', 1)->count(),
            'noche' => $this->categories->where('day', 0)->count(),
            'animales' => $this->categories->where('animal', 1)->count(),
            'sinanimales' => $this->categories->where('animal', 0)->count(),
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
