<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipio extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_departamento',
        'codigo_municipio',
        'nombre_municipio'
    ];

    protected $hidden = ['id_departamento'];
    /**
     * Get the user that owns the Municipio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    /**
     * Get all of the comments for the Municipio
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aldea(): HasMany
    {
        return $this->hasMany(Aldea::class);
    }

    public function centro_votacion(): HasMany
    {
        return $this->hasMany(Aldea::class);
    }

    public function acta(): HasMany
    {
        return $this->hasMany(Aldea::class);
    }

    public function persona_movimiento(): HasMany
    {
        return $this->hasMany(PersonasMovimiento::class);
    }
}
