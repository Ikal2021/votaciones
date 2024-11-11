<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aldea extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_departamento',
        'id_municipio',
        'codigo_aldea',
        'nombre_aldea'
    ];

    protected $hidden = ['id_departamento','id_municipio'];

    /**
     * Get the user that owns the Aldea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }

    /**
     * Get all of the comments for the Aldea
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centro_votacion(): HasMany
    {
        return $this->hasMany(CentroVotacion::class);
    }

    public function acta(): HasMany
    {
        return $this->hasMany(Acta::class);
    }

    public function persona_movimiento(): HasMany
    {
        return $this->hasMany(PersonasMovimiento::class);
    }
}
