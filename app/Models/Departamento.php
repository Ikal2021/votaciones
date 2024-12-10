<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory;
    protected $fillable =[
        'codigo_departamento',
        'nombre_departamento'
    ];

    /**
     * Get all of the comments for the Departamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     //Relacio uno a muchos
    public function municipio(): HasMany
    {
        return $this->hasMany(Municipio::class);
    }

    public function aldea(): HasMany
    {
        return $this->hasMany(Aldea::class);
    }

    public function persona_movimiento(): HasMany
    {
        return $this->hasMany(PersonasMovimiento::class);
    }

    public function centro_votacion(): HasMany
    {
        return $this->hasMany(CentroVotacion::class);
    }

    public function acta(): HasMany
    {
        return $this->hasMany(Acta::class);
    }
}

