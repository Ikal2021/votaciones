<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partido extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_partido'];

    /**
     * Get all of the comments for the Partido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     //Relacion uno a muchos
    public function movimiento(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }

    public function persona_movimiento(): HasMany
    {
        return $this->hasMany(PersonasMovimiento::class);
    }

    public function acta(): HasMany
    {
        return $this->hasMany(Acta::class);
    }
}
