<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;
    protected $fillable =['descripcion_area'];
    /**
     * Get all of the comments for the Area
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     //Relacion uno a muchos
    public function centro_votacion(): HasMany
    {
        return $this->hasMany(CentroVotacion::class);
    }

    public function lugar_poblado(): HasMany
    {
        return $this->hasMany(Lugarpoblado::class);
    }

    public function acta(): HasMany
    {
        return $this->hasMany(Acta::class);
    }
}
