<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Persona extends Model
{
    use HasFactory;
    protected $fillable =[
        'dni',
        'nombres',
        'apellidos',
        'genero',
        'fecha_nacimiento',
        'lugar_nacimiento'
    ];

    /**
     * Get all of the comments for the Persona
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
    //Relacion uno a muchos
    public function persona_movimiento(): HasMany
    {
        return $this->hasMany(PersonasMovimiento::class);
    }
}
