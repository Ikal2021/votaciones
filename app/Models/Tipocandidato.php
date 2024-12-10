<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoCandidato extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_candidato'];

    //Relacion Uno a Muchos
    public function persona_movimiento(): HasMany
    {
        return $this->hasMany(PersonasMovimiento::class);
    }
}